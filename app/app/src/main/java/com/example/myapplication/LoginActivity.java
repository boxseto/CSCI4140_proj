package com.example.myapplication;

import android.content.Intent;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

public class LoginActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        final EditText input_username = (EditText) findViewById(R.id.username);
        final EditText input_password = (EditText) findViewById(R.id.password);
        final Button logBut = (Button) findViewById(R.id.loginButton);

        logBut.setOnClickListener(new View.OnClickListener(){
            @Override
            public void onClick(View v){
                final String username = input_username.getText().toString();
                final String password = input_password.getText().toString();

                Response.Listener<String> responseListener = new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        try{
                            Log.i("tagconvertstr", "["+response+"]");
                            JSONObject jsonResponse  = new JSONObject(response);
                            boolean success = jsonResponse.getBoolean("success");

                            if (success){
                                int userId = jsonResponse.getInt("id");
                                String userName = jsonResponse.getString("name");
                                String userContact = jsonResponse.getString("contact");
                                int userType = jsonResponse.getInt("type");

                                Intent intent = new Intent(getApplicationContext(), MainActivity.class);
                                intent.putExtra("id", userId);
                                intent.putExtra("username", userName);
                                intent.putExtra("contact", userContact);
                                intent.putExtra("type", userType);
                                startActivity(intent);
                            }else{
                                AlertDialog.Builder builder = new AlertDialog.Builder(LoginActivity.this);
                                builder.setMessage("Login failed")
                                        .setNegativeButton("Retry", null)
                                        .create()
                                        .show();
                            }

                        }catch(JSONException e ){
                            e.printStackTrace();
                        }

                    }
                };

                LoginRequest loginRequest = new LoginRequest(username, password, responseListener);
                RequestQueue queue = Volley.newRequestQueue(LoginActivity.this);
                queue.add(loginRequest);

            }
        });
    }
}
