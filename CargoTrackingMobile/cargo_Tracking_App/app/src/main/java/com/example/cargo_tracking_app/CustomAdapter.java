package com.example.cargo_tracking_app;

import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.graphics.drawable.Drawable;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import androidx.core.content.ContextCompat;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class CustomAdapter extends BaseAdapter {

    int[] o_id;
    String[] to_name;
    String[] to_district;
    Context context;//mtl this
    JSONArray data;
    String host, w_id = "";
    LayoutInflater inflater = null;


    public CustomAdapter(int[] o_id, String[] to_name, String[] to_district, Context context) {
        this.o_id = o_id;
        this.to_name = to_name;
        this.to_district = to_district;
        this.context = context;
        inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);//bye5od shakel l row
    }

    public CustomAdapter(Context context, JSONArray data, String host, String w_id) {
        this.context = context;
        this.data = data;
        this.host = host;
        this.w_id = w_id;
        inflater = (LayoutInflater) context.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    @Override
    public int getCount() {
        return data.length();
    }

    @Override
    public Object getItem(int i) {
        return null;
    }

    @Override
    public long getItemId(int i) {
        return 0;
    }

    @Override
    public View getView(int i, View view, ViewGroup viewGroup) {
        final View rowView;
        rowView = inflater.inflate(R.layout.row_aorders, null);
        TextView tv_t = (TextView) rowView.findViewById(R.id.tvt);
        TextView tv_e = (TextView) rowView.findViewById(R.id.tve);
        TextView tv_l = (TextView) rowView.findViewById(R.id.tvl);
        Button details = (Button) rowView.findViewById(R.id.bt_details);


        JSONObject ob = data.optJSONObject(i);
        try {
            String n = ob.getString("to_address");
            int id = ob.getInt("o_id");
            tv_t.setText("#" + id);
            if (ob.getString("urgent").equals("1")) {
                tv_t.setText("#" + id+" !");
                int color = ContextCompat.getColor(context, R.color.danger);
                tv_t.setTextColor(color);
                //tv_t.setTextColor(Color.RED);
            }
            tv_e.setText(ob.getString("to_name"));
            tv_l.setText(ob.getString("to_district"));
            rowView.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View rowView) {
                    if (n != null) {
                        Toast.makeText(context, n, Toast.LENGTH_SHORT).show(); //district
                    }
                }
            });

            details.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View view) {
                    Intent i = new Intent(context, details.class);
                    i.putExtra("o_id", id);
                    context.startActivity(i);
                }
            });
        } catch (JSONException e) {
            e.printStackTrace();
        }

        return rowView;
    }
}


/*was inside onClick
AlertDialog.Builder mb = new AlertDialog.Builder(context);
                    mb.setIcon(R.drawable.gear2icon);
                    mb.setTitle("confirm");
                    mb.setMessage("Are you sure you want to details it?");
                    mb.setPositiveButton("yes", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            String url = "http://" + host.trim() + "/seniorProject/CargoTrackingMobile/detailsseries.php?s_name=" + n + "&w_id=" + w_id;
                            RequestQueue queue = Volley.newRequestQueue(context);
                            StringRequest request = new StringRequest(Request.Method.GET, url, new Response.Listener<String>() {
                                @Override
                                public void onResponse(String response) {
                                    Toast.makeText(context, response, Toast.LENGTH_SHORT).show();
                                    ((availableOrders) context).onResume();
                                }
                            }, new Response.ErrorListener() {
                                @Override
                                public void onErrorResponse(VolleyError error) {
                                    Toast.makeText(context, "Error:" + error.toString(), Toast.LENGTH_SHORT).show();
                                }
                            });
                            queue.add(request);
                        }
                    });
                    mb.setNegativeButton("Cancel", new DialogInterface.OnClickListener() {
                        @Override
                        public void onClick(DialogInterface dialog, int which) {
                            dialog.dismiss();
                        }
                    });
                    Dialog d = mb.create();
                    d.show();*/