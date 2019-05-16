package com.example.myapplication;

import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import java.io.IOException;
import java.text.SimpleDateFormat;

import okhttp3.Headers;
import okhttp3.MultipartBody;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.RequestBody;
import okhttp3.Response;

public class seat_map extends AppCompatActivity {
    private final OkHttpClient client = new OkHttpClient();
    TextView seat1;
    TextView seat2;
    TextView seat3;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_seat_map);
        SharedPreferences a = getSharedPreferences("MAP", 0);
        a.edit().putString("verify", "TRUE").apply();

        Button back = (Button) findViewById(R.id.seat_map_back);
        seat1 = (TextView) findViewById(R.id.seat_1);
        seat2 = (TextView) findViewById(R.id.seat_2);
        seat3 = (TextView) findViewById(R.id.seat_3);

        back.setOnClickListener(new Button.OnClickListener() {
            public void onClick(View v) {
                Intent intent = new Intent(getApplicationContext(), MainActivity.class);
                intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TASK);
                startActivity(intent);
            }
        });
    }

    @Override
    protected void onStart(){
        super.onStart();
        RequestBody requestBody = new MultipartBody.Builder()
                .setType(MultipartBody.FORM)
                .addFormDataPart("tmp", "temp String")
                .build();

        Request request = new Request.Builder()
                .url("http://10.0.2.2/gettime.php")
                .post(requestBody)
                .build();

        try (Response response = client.newCall(request).execute()) {
            if (!response.isSuccessful()) throw new IOException("Unexpected code " + response);

            Headers responseHeaders = response.headers();
            for (int i = 0; i < responseHeaders.size(); i++) {
                Log.e("CODE_VERIFY",responseHeaders.name(i) + ": " + responseHeaders.value(i));
            }
            String result = response.body().string();
            String[] times = result.split("~");
            changeseat1(times[0]);
            changeseat2(times[1]);
            changeseat3(times[2]);

        } catch (IOException e) {
            e.printStackTrace();
        }
    }

    private void changeseat1(String time){
        String[] timeDetails = time.split(":");
        SimpleDateFormat dateform = new SimpleDateFormat("hh:mm");
        String current = dateform.format(new java.util.Date());
        String[] curDetails = current.split(":");
        int h = Integer.getInteger(curDetails[0]) - Integer.getInteger(timeDetails[0]);
        int m = Integer.getInteger(curDetails[1]) - Integer.getInteger(timeDetails[1]);
        if(h > 1){
            seat1.setBackgroundColor(Color.parseColor("#CDDC39"));
            seat1.setTextColor(Color.parseColor("#000000"));
        }else{
            if(m > 30){
                seat1.setBackgroundColor(Color.parseColor("#2196F3"));
                seat1.setTextColor(Color.parseColor("#000000"));
            }else{
                seat1.setBackgroundColor(Color.parseColor("#000000"));
                seat1.setTextColor(Color.parseColor("#FFFFFF"));
            }
        }
        seat1.setText(h + ":" + m);
    }
    private void changeseat2(String time){
        String[] timeDetails = time.split(":");
        SimpleDateFormat dateform = new SimpleDateFormat("hh:mm");
        String current = dateform.format(new java.util.Date());
        String[] curDetails = current.split(":");
        int h = Integer.getInteger(curDetails[0]) - Integer.getInteger(timeDetails[0]);
        int m = Integer.getInteger(curDetails[1]) - Integer.getInteger(timeDetails[1]);
        if(h > 1){
            seat2.setBackgroundColor(Color.parseColor("#CDDC39"));
            seat2.setTextColor(Color.parseColor("#000000"));
        }else{
            if(m > 30){
                seat2.setBackgroundColor(Color.parseColor("#2196F3"));
                seat2.setTextColor(Color.parseColor("#000000"));
            }else{
                seat2.setBackgroundColor(Color.parseColor("#000000"));
                seat2.setTextColor(Color.parseColor("#FFFFFF"));
            }
        }
        seat2.setText(h + ":" + m);
    }
    private void changeseat3(String time){
        String[] timeDetails = time.split(":");
        SimpleDateFormat dateform = new SimpleDateFormat("hh:mm");
        String current = dateform.format(new java.util.Date());
        String[] curDetails = current.split(":");
        int h = Integer.getInteger(curDetails[0]) - Integer.getInteger(timeDetails[0]);
        int m = Integer.getInteger(curDetails[1]) - Integer.getInteger(timeDetails[1]);
        if(h > 1){
            seat3.setBackgroundColor(Color.parseColor("#CDDC39"));
            seat3.setTextColor(Color.parseColor("#000000"));
        }else{
            if(m > 30){
                seat3.setBackgroundColor(Color.parseColor("#2196F3"));
                seat3.setTextColor(Color.parseColor("#000000"));
            }else{
                seat3.setBackgroundColor(Color.parseColor("#000000"));
                seat3.setTextColor(Color.parseColor("#FFFFFF"));
            }
        }
        seat3.setText(h + ":" + m);
    }
}
