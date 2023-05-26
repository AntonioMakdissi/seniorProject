package com.example.cargo_tracking_app;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.view.View;
import android.widget.ListView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.cargo_tracking_app.databinding.ActivityAvailableOrdersBinding;
import com.google.android.material.snackbar.Snackbar;

import org.json.JSONArray;

public class availableOrders extends AppCompatActivity {

    ListView lvwl;
    String ip, w_id;
    final static String keyID = "IDKey", keyIP = "IPKey";
    SharedPreferences sharedPref;
    private ActivityAvailableOrdersBinding binding;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        binding = ActivityAvailableOrdersBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());

        setSupportActionBar(binding.toolbar);

        lvwl = (ListView) findViewById(R.id.lvw);
        sharedPref = getSharedPreferences("keys", Context.MODE_PRIVATE);
        if (sharedPref.contains(keyIP)) {
            ip = sharedPref.getString(keyIP, "test");
        }
        if (sharedPref.contains(keyID)) {
            w_id = sharedPref.getString(keyID, "test"); //default is test;
        }
        getdatafromdb();
        //int[] imageids = {R.drawable.da_brothers, R.drawable.___nothing_happened, R.drawable.__second_gear, R.drawable.___second_and_third_gear_combined};
        //String[] names = {"One Piece", "Game Of Thrones", "second gear"};
        //int[] epnbr = {1050, 360, 300};
        //int[] epl = {20, 20, 60};


        binding.fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                //timeWatched(view);
                Snackbar.make(view, "Today's orders", Snackbar.LENGTH_LONG).setAction("Action", null).show();


            }
        });
    }

    /*public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_orders, menu);
        return true;
    }

        @Override
        public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_messages) {
            myAdd();

            return true;
        } *//*else if (id == R.id.action_logout) {

            return true;
        }
*//*
        return super.onOptionsItemSelected(item);
    }*/

    public void getdatafromdb() {
        String url = "http://" + ip.trim() + "/seniorProject/CargoTrackingMobile/getorders.php?w_id=" + Integer.parseInt(w_id.trim());
        RequestQueue queue = Volley.newRequestQueue(this);
        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(Request.Method.GET, url, null, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                CustomAdapter adapter = new CustomAdapter(availableOrders.this, response, ip, w_id);
                lvwl.setAdapter(adapter);


            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), error.toString(), Toast.LENGTH_LONG).show();
            }
        });

        queue.add(jsonArrayRequest);
    }

    @Override
    protected void onResume() {
        getdatafromdb();
        super.onResume();
    }

    public void myAdd() {
        Intent i = new Intent(getApplicationContext(), details.class);
        startActivity(i);
    }

    public void timeWatched(View view) {
        String url = "http://" + ip.trim() + "/seniorProject/CargoTrackingMobile/timeWatched.php?w_id=" + w_id.trim();
        RequestQueue queue = Volley.newRequestQueue(this);
        StringRequest request = new StringRequest(Request.Method.GET, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                Snackbar.make(view, response, Snackbar.LENGTH_LONG).setAction("Action", null).show();


            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), "Error:" + error.toString(), Toast.LENGTH_SHORT).show();
            }
        });
        queue.add(request);
    }

/*
    public void remove(View v) {
        AlertDialog.Builder mb = new AlertDialog.Builder(this);
        mb.setIcon(R.drawable.gear2icon);
        mb.setTitle("confirm");
        mb.setMessage("Are you sure you want to remove it?");
        mb.setPositiveButton("yes", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                Toast.makeText(getApplicationContext(), "not working yet", Toast.LENGTH_SHORT).show();
            }
        });
        mb.setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int which) {
                dialog.dismiss();
            }
        });
        Dialog d = mb.create();
        d.show();
    }*/

}