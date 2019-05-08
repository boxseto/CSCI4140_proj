package com.example.myapplication;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import java.io.IOException;
import java.net.HttpURLConnection;
import java.net.URL;

import okhttp3.Headers;
import okhttp3.MultipartBody;
import okhttp3.OkHttpClient;
import okhttp3.Request;
import okhttp3.RequestBody;
import okhttp3.Response;

public class Code_verify extends AppCompatActivity {

    private final OkHttpClient client = new OkHttpClient();
    EditText verifyCode;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_code_verify);

        SharedPreferences a = getSharedPreferences("MAP", 0);
        TextView restaurant = (TextView) findViewById(R.id.restaurant_name);
        Button btn = (Button) findViewById(R.id.verify_submit);
        verifyCode = (EditText) findViewById(R.id.verify_code);

        restaurant.setText(a.getString("seat", "NULL"));

        btn.setOnClickListener(new Button.OnClickListener(){
            public void onClick(View v) {
                if(verifyCode.getText().toString().isEmpty()){
                    Toast.makeText(getApplicationContext(), "Empty Code!" , Toast.LENGTH_SHORT).show();
                }else{
                    makerequest();
                }
            }
        });
    }

    private void makerequest(){
        RequestBody requestBody = new MultipartBody.Builder()
                .setType(MultipartBody.FORM)
                .addFormDataPart("code", verifyCode.getText().toString())
                .build();

        Request request = new Request.Builder()
                .url("http://10.0.2.2/checkVerify.php")
                .post(requestBody)
                .build();

        try (Response response = client.newCall(request).execute()) {
            if (!response.isSuccessful()) throw new IOException("Unexpected code " + response);

            Headers responseHeaders = response.headers();
            for (int i = 0; i < responseHeaders.size(); i++) {
                Log.e("CODE_VERIFY",responseHeaders.name(i) + ": " + responseHeaders.value(i));
            }

            if(response.body().string().contentEquals("YES")){
                SharedPreferences a = getSharedPreferences("MAP", 0);
                a.edit().putString("verify", "TRUE").apply();
                Intent intent = new Intent(getApplicationContext(), seat_map.class);
                startActivity(intent);
            }else{
                Toast.makeText(this, "WRONG verify code!", Toast.LENGTH_SHORT).show();

            }
        } catch (IOException e) {
            e.printStackTrace();
        }
    }
}
