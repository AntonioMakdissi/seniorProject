package com.example.cargo_tracking_app;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.google.android.material.snackbar.Snackbar;

import androidx.appcompat.app.AppCompatActivity;

import android.text.TextUtils;
import android.view.View;

import androidx.navigation.NavController;
import androidx.navigation.Navigation;
import androidx.navigation.ui.AppBarConfiguration;
import androidx.navigation.ui.NavigationUI;

import com.example.cargo_tracking_app.databinding.ActivityMainBinding;

import android.view.Menu;
import android.view.MenuItem;
import android.widget.EditText;
import android.widget.Toast;

public class MainActivity extends AppCompatActivity {

    private ActivityMainBinding binding;
    EditText edName, edPassword, edIP;
    public final static String keyName = "nameKey", keyPass = "passKey", keyIP = "IPKey", keyID = "IDKey";
    SharedPreferences sharedPref;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        binding = ActivityMainBinding.inflate(getLayoutInflater());
        setContentView(binding.getRoot());
        setSupportActionBar(binding.toolbar);

        edName = (EditText) findViewById(R.id.ed_name);
        edPassword = (EditText) findViewById(R.id.ed_password);
        edIP = (EditText) findViewById(R.id.ed_ip);
        myLoad();

        binding.fab.setOnClickListener(new View.OnClickListener() {
            @Override//unused
            public void onClick(View view) {
                Snackbar.make(view, "Authorized Personnel Only", Snackbar.LENGTH_LONG).setAction("Action", null).show();
            }
        });
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_save) {
            mySave();

            return true;
        } else if (id == R.id.action_load) {
            myLoad();

            return true;
        }

        return super.onOptionsItemSelected(item);
    }

    private void mySave() {//save credentials on phone
        sharedPref = getSharedPreferences("keys", Context.MODE_PRIVATE);//getSharedPreferences if we have many
        SharedPreferences.Editor editor = sharedPref.edit();
        editor.putString(keyName, edName.getText().toString());//save as key-value
        editor.putString(keyPass, edPassword.getText().toString());
        editor.putString(keyIP, edIP.getText().toString().trim());
        editor.commit(); //save changes
        Toast.makeText(getApplicationContext(), "Credentials saved", Toast.LENGTH_SHORT).show();
    }

    private void mySave2(String w_id) {//save credentials on phone
        sharedPref = getSharedPreferences("keys",Context.MODE_PRIVATE);//getSharedPreferences if we have many
        SharedPreferences.Editor editor = sharedPref.edit();
        editor.putString(keyName, edName.getText().toString());//save as key-value
        editor.putString(keyPass, edPassword.getText().toString());
        editor.putString(keyIP, edIP.getText().toString().trim());
        editor.putString(keyID, w_id.trim());
        editor.commit(); //save changes
        //Toast.makeText(getApplicationContext(), "Credentials saved", Toast.LENGTH_SHORT).show();
    }

    private void myLoad() { //load credentials from phone
        sharedPref = getSharedPreferences("keys",Context.MODE_PRIVATE); //getSharedPreferences if we have many
        if (sharedPref.contains(keyName)) {
            String name = sharedPref.getString(keyName, "test"); //default is test
            edName.setText(name);
        }
        if (sharedPref.contains(keyPass)) {
            String pass = sharedPref.getString(keyPass, "test"); //default is test
            edPassword.setText(pass);
            Toast.makeText(getApplicationContext(), "Credentials loaded", Toast.LENGTH_SHORT).show();
        }
        if (sharedPref.contains(keyIP)) {
            String ip = sharedPref.getString(keyIP, "test"); //default is test
            edIP.setText(ip);
        }

    }

    public void logIn(View v) { //checks credentials in database then takes you to next activity
        if (checker()) {
            //checker should be here
            String n = edName.getText().toString();
            String p = edPassword.getText().toString();
            String ip = edIP.getText().toString();

            String url = "http://" + ip.trim() + "/seniorProject/CargoTrackingMobile/login.php?name=" + n + "&password=" + p;
            RequestQueue queue = Volley.newRequestQueue(this);
            StringRequest request = new StringRequest(Request.Method.GET, url, new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    if (response.matches("\\d+")){
                        String w_id= response;//parse int?
                        mySave2(w_id);//save credentials with w_id
                        Toast.makeText(getApplicationContext(), "Credentials saved\nWelcome!", Toast.LENGTH_SHORT).show();
                        Intent i = new Intent(getApplicationContext(), availableOrders.class);
                        startActivity(i);
                    } else{
                        Toast.makeText(getApplicationContext(), response, Toast.LENGTH_LONG).show();
                    }
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(getApplicationContext(), "Error:" + error.toString(), Toast.LENGTH_SHORT).show();
                }
            });
            queue.add(request);
        }
    }

    /*public void signUp(View v) { //creates new credentials in database to use with login
        if (checker()) {
            String n = edName.getText().toString();
            String p = edPassword.getText().toString();
            String ip = edIP.getText().toString();
            String url = "http://" + ip.trim() + "/seniorProject/CargoTrackingMobile/signup.php?name=" + n + "&password=" + p;
            RequestQueue queue = Volley.newRequestQueue(this);
            StringRequest request = new StringRequest(Request.Method.GET, url, new Response.Listener<String>() {
                @Override
                public void onResponse(String response) {
                    Toast.makeText(getApplicationContext(), response, Toast.LENGTH_SHORT).show();

                    mySave();
                    //logIn(v);
                }
            }, new Response.ErrorListener() {
                @Override
                public void onErrorResponse(VolleyError error) {
                    Toast.makeText(getApplicationContext(), "Error:" + error.toString(), Toast.LENGTH_SHORT).show();
                }
            });
            queue.add(request);
        }
    }*/

    protected boolean checker() {
        if (TextUtils.isEmpty(edName.getText().toString())) {
            edName.setError("Empty field!");
        } else if (TextUtils.isEmpty(edPassword.getText().toString())) {
            edPassword.setError("Empty field!");
        } else if (TextUtils.isEmpty(edIP.getText().toString())) {
            edIP.setError("Empty field!");
        } else {
            return true;
        }
        return false;
    }
}