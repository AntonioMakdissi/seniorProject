package com.example.cargo_tracking_app;

import android.app.NotificationChannel;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Build;
import android.os.Bundle;
import android.text.TextUtils;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.NotificationCompat;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.cargo_tracking_app.databinding.ActivityMainBinding;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.android.material.snackbar.Snackbar;
import com.google.firebase.messaging.FirebaseMessaging;

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

        // Obtain the device token
        /*FirebaseMessaging.getInstance().getToken()
                .addOnCompleteListener(new OnCompleteListener<String>() {
                    @Override
                    public void onComplete(@NonNull Task<String> task) {
                        if (!task.isSuccessful()) {
                            System.out.println("Fetching FCM registration token failed");
                            return;
                        }

                        // Get new FCM registration token
                        String token = task.getResult();

                        // Log and toast

                        System.out.println(token);
                        Toast.makeText(MainActivity.this, token, Toast.LENGTH_SHORT).show();
                        EditText edToken=(EditText) findViewById(R.id.token);
                        edToken.setText(token+"");
                    }
                });*/
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
        sharedPref = getSharedPreferences("keys", Context.MODE_PRIVATE);//getSharedPreferences if we have many
        SharedPreferences.Editor editor = sharedPref.edit();
        editor.putString(keyName, edName.getText().toString());//save as key-value
        editor.putString(keyPass, edPassword.getText().toString());
        editor.putString(keyIP, edIP.getText().toString().trim());
        editor.putString(keyID, w_id.trim());
        editor.commit(); //save changes
        //Toast.makeText(getApplicationContext(), "Credentials saved", Toast.LENGTH_SHORT).show();
    }

    private void myLoad() { //load credentials from phone
        sharedPref = getSharedPreferences("keys", Context.MODE_PRIVATE); //getSharedPreferences if we have many
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
                    if (response.matches("\\d+")) {
                        String w_id = response;//parse int?
                        mySave2(w_id);//save credentials with w_id
                        Toast.makeText(getApplicationContext(), "Credentials saved\nWelcome!", Toast.LENGTH_SHORT).show();
                        Intent i = new Intent(getApplicationContext(), availableOrders.class);
                        startActivity(i);
                    } else {
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

    public void sendNotification(View v) {
        int notificationId = 1;
// Create an intent to launch when the user taps the notification
        Intent intent = new Intent(getApplicationContext(), availableOrders.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        PendingIntent pendingIntent = PendingIntent.getActivity(getApplicationContext(), 0, intent, 0);

// Build the notification
        NotificationCompat.Builder builder = new NotificationCompat.Builder(getApplicationContext(), "channel_id").setSmallIcon(R.drawable.icon).setContentTitle("New Urgent Order").setContentText("Click here").setContentIntent(pendingIntent).setAutoCancel(true);

// Get the NotificationManager
        NotificationManager notificationManager = (NotificationManager) getApplicationContext().getSystemService(Context.NOTIFICATION_SERVICE);

// Check if the device is running Android 8.0 (Oreo) or higher
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.O) {
            // Create a notification channel (required for Android 8.0 and above)
            String channelId = "channel_id";
            String channelName = "Channel Name";
            NotificationChannel channel = new NotificationChannel(channelId, channelName, NotificationManager.IMPORTANCE_DEFAULT);
            notificationManager.createNotificationChannel(channel);
            builder.setChannelId(channelId);
        }

// Send the notification
        notificationManager.notify(notificationId, builder.build());


    }
}