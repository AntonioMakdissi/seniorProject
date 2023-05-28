package com.example.cargo_tracking_app;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;
import androidx.core.content.ContextCompat;
import androidx.navigation.ui.AppBarConfiguration;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.cargo_tracking_app.databinding.ActivityDetailsBinding;
import com.google.android.material.snackbar.Snackbar;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class details extends AppCompatActivity {

    private AppBarConfiguration appBarConfiguration;
    String ip, w_id="0";
    int o_id=0;
    final static String keyID = "IDKey", keyIP = "IPKey";
    Spinner spinner;
    SharedPreferences sharedPref;
    private ActivityDetailsBinding binding;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        binding = ActivityDetailsBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        setSupportActionBar(binding.toolbar);

        sharedPref = getSharedPreferences("keys", Context.MODE_PRIVATE);
        if (sharedPref.contains(keyIP)) {
            ip = sharedPref.getString(keyIP, "test");
        }
        if (sharedPref.contains(keyID)) {
            w_id = sharedPref.getString(keyID, "test"); //default is test;
        }
        // Get the order ID passed from the previous activity
        Intent intent = getIntent();
        o_id = intent.getIntExtra("o_id", 0);

        binding.fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Snackbar.make(view, "Select where you will drop off the package", Snackbar.LENGTH_LONG).setAction("Action", null).show();
            }
        });

        spinner = findViewById(R.id.spinner_id);

        // Get the TextViews to display the order details
        TextView orderNumberTv = findViewById(R.id.o_id);
        TextView fromTv = findViewById(R.id.from);
        TextView phoneTv = findViewById(R.id.phone);
        TextView districtTv = findViewById(R.id.district);
        TextView addressTv = findViewById(R.id.address);
        TextView locTv = findViewById(R.id.current_location);
        TextView toNameTv = findViewById(R.id.to_name);
        TextView toPhoneTv = findViewById(R.id.to_phone);
        TextView toDistrictTv = findViewById(R.id.to_district);
        TextView toAddressTv = findViewById(R.id.to_address);
        TextView priceTv = findViewById(R.id.price);
        TextView cashTv = findViewById(R.id.cash);
        TextView fragileTv = findViewById(R.id.fragile);
        TextView urgentTv = findViewById(R.id.urgent);
        TextView payerTv = findViewById(R.id.payer);
        //TextView locTv = findViewById(R.id.loc);

        // Make a request to the server to get the order details
        String url = "http://" + ip.trim() + "/seniorProject/CargoTrackingMobile/getdetails.php?o_id=" + o_id;
        RequestQueue queue = Volley.newRequestQueue(this);
        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(Request.Method.GET, url, null, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                try {
                    // Set the text of the TextViews to display the order details
                    JSONObject jsonObject = response.getJSONObject(0);
                    orderNumberTv.setText("#" + jsonObject.getInt("o_id"));
                    fromTv.setText(" " + jsonObject.getString("c_name"));
                    phoneTv.setText(" " + jsonObject.getString("c_phone"));
                    districtTv.setText(" " + jsonObject.getString("c_district"));
                    addressTv.setText(" " + jsonObject.getString("c_address"));
                    locTv.setText(" " + jsonObject.getString("current_location"));
                    toNameTv.setText(" " + jsonObject.getString("to_name"));
                    toPhoneTv.setText(" " + jsonObject.getString("to_phone"));
                    toDistrictTv.setText(" " + jsonObject.getString("to_district"));
                    toAddressTv.setText(" " + jsonObject.getString("to_address"));
                    priceTv.setText(jsonObject.getDouble("f_price") + " $");
                    cashTv.setText(jsonObject.getString("pay_at_delivery").equals("1") ? "yes" : "no");
                    fragileTv.setText(jsonObject.getString("fragile").equals("1") ? "yes" : "no");
                    payerTv.setText(jsonObject.getString("sender_pays").equals("1") ? "Sender" : "Receiver");
                    urgentTv.setText(jsonObject.getString("urgent").equals("1") ? "yes" : "no");
                    if (jsonObject.getString("urgent").equals("1")) {

                        int color = ContextCompat.getColor(getApplicationContext(), R.color.danger);
                        urgentTv.setTextColor(color);
                    }
                    //locTv.setText(getString(R.string.loc) + " " + jsonObject.getString("current_location"));
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), error.toString(), Toast.LENGTH_LONG).show();

            }
        });

        // Add the request to the RequestQueue
        queue.add(jsonArrayRequest);

        //set up SPINNER
        // Define the URL of the PHP script
        url = "http://" + ip.trim() + "/seniorProject/CargoTrackingMobile/getbranches.php";

        // Create a new request queue
        //queue = Volley.newRequestQueue(this);

        // Create a new string request to fetch the JSON array
        StringRequest stringRequest = new StringRequest(Request.Method.GET, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    // Convert the response to a JSON array
                    JSONArray jsonArray = new JSONArray(response);

                    // Initialize an array to store the spinner items
                    String[] spinnerItems = new String[jsonArray.length()];

                    // Loop through the JSON array and add the items to the spinner array
                    for (int i = 0; i < jsonArray.length(); i++) {
                        spinnerItems[i] = jsonArray.getString(i);
                    }

                    // Create an adapter for the spinner
                    ArrayAdapter<String> adapter = new ArrayAdapter<>(details.this, android.R.layout.simple_spinner_item, spinnerItems);

                    // Set the adapter for the spinner
                    spinner.setAdapter(adapter);

                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                // Handle errors
            }
        });

        // Add the request to the request queue
        queue.add(stringRequest);


        spinner.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parentView, View selectedItemView, int position, long id) {
                String selectedItem = (String) parentView.getItemAtPosition(position);
                Toast.makeText(getApplicationContext(), "Selected: " + selectedItem, Toast.LENGTH_SHORT).show();
            }

            @Override
            public void onNothingSelected(AdapterView<?> parentView) {
                // Do nothing
            }
        });
    }

    public void submit(View v) {
        // Get the selected value from the spinner
        String selectedValue = spinner.getSelectedItem().toString();

        // Define the base URL of the PHP script
        String baseUrl = "http://" + ip.trim() + "/seniorProject/CargoTrackingMobile/deliver.php";

        // Append the query parameters to the base URL
        String url = baseUrl + "?w_id=" + w_id.trim() + "&o_id=" + o_id + "&current_location=" + selectedValue.trim();

        // Create a new request queue
        RequestQueue queue = Volley.newRequestQueue(getApplicationContext());

        // Create a new string request to send the selected value to the PHP script
        StringRequest stringRequest = new StringRequest(Request.Method.GET, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                Toast.makeText(getApplicationContext(), response, Toast.LENGTH_SHORT).show();
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), error.toString(), Toast.LENGTH_LONG).show();
            }
        });

        // Add the request to the request queue
        queue.add(stringRequest);
    }


}
