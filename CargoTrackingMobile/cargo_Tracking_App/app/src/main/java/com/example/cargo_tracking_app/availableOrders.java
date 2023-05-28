package com.example.cargo_tracking_app;

import android.app.NotificationChannel;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.database.ContentObserver;
import android.net.Uri;
import android.os.Build;
import android.os.Bundle;
import android.os.Handler;
import android.view.View;
import android.widget.ListView;
import android.widget.Toast;

import androidx.annotation.NonNull;
import androidx.appcompat.app.AppCompatActivity;
import androidx.core.app.NotificationCompat;
import androidx.core.app.NotificationManagerCompat;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.cargo_tracking_app.databinding.ActivityAvailableOrdersBinding;
import com.google.android.gms.tasks.OnCompleteListener;
import com.google.android.gms.tasks.Task;
import com.google.android.material.snackbar.Snackbar;
import com.google.firebase.messaging.FirebaseMessaging;

import org.json.JSONArray;

public class availableOrders extends AppCompatActivity {

    private static final long REFRESH_INTERVAL = 30000; // 30 seconds
    private Handler handler;
    private Runnable refreshRunnable;
    private static final int notificationId = 1;
    private static final String CHANNEL_ID = "my_channel";
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
        super.onResume();
        getdatafromdb();

        // Initialize the handler and runnable
        handler = new Handler();
        refreshRunnable = new Runnable() {
            @Override
            public void run() {
                getdatafromdb();
                handler.postDelayed(this, REFRESH_INTERVAL);
            }
        };

        // Start the refresh process initially
        handler.postDelayed(refreshRunnable, REFRESH_INTERVAL);
    }

    @Override
    protected void onPause() {
        super.onPause();
        // Stop the refresh process when the activity is paused
        handler.removeCallbacks(refreshRunnable);
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


    private void sendNotification() {
// Create an intent to launch when the user taps the notification
        Intent intent = new Intent(getApplicationContext(), availableOrders.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
        PendingIntent pendingIntent = PendingIntent.getActivity(getApplicationContext(), 0, intent, 0);

// Build the notification
        NotificationCompat.Builder builder = new NotificationCompat.Builder(getApplicationContext(), "channel_id").setSmallIcon(R.drawable.icon).setContentTitle("Notification Title").setContentText("Notification Text").setContentIntent(pendingIntent).setAutoCancel(true);

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

    private void sendNotification2() {
        // Create a notification builder
        NotificationCompat.Builder builder = new NotificationCompat.Builder(this, CHANNEL_ID).setSmallIcon(R.drawable.icon).setContentTitle("Notification Title").setContentText("Notification Text").setPriority(NotificationCompat.PRIORITY_DEFAULT);

        // Create an explicit intent for the activity you want to open when the notification is clicked
        Intent intent = new Intent(this, availableOrders.class);
        PendingIntent pendingIntent = PendingIntent.getActivity(this, 0, intent, PendingIntent.FLAG_UPDATE_CURRENT);
        builder.setContentIntent(pendingIntent);

        // Show the notification
        NotificationManagerCompat notificationManager = NotificationManagerCompat.from(this);
        notificationManager.notify(notificationId, builder.build());
    }

}