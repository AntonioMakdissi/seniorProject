package com.example.cargo_tracking_app;

import com.google.firebase.messaging.FirebaseMessagingService;
import com.google.firebase.messaging.RemoteMessage;

public class MyFirebaseMessagingService extends FirebaseMessagingService {
    @Override
    public void onMessageReceived(RemoteMessage remoteMessage) {
        // Handle the received message
        if (remoteMessage.getNotification() != null) {
            // Display the notification
            String title = remoteMessage.getNotification().getTitle();
            String message = remoteMessage.getNotification().getBody();
            // TODO: Handle the notification based on your app's requirements
        }
    }

    @Override
    public void onNewToken(String token) {
        // Handle token refresh
        // TODO: Send the new token to your server
    }
}