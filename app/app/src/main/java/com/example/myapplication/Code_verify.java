package com.example.myapplication;

import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

public class Code_verify extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_code_verify);

        SharedPreferences a = getSharedPreferences("MAP", 0);
        TextView restaurant = (TextView) findViewById(R.id.restaurant_name);
        Button btn = (Button) findViewById(R.id.verify_submit);
        final EditText verifyCode = (EditText) findViewById(R.id.verify_code);

        restaurant.setText(a.getString("seat", "NULL"));

        btn.setOnClickListener(new Button.OnClickListener(){
            public void onClick(View v) {
                if(verifyCode.getText().toString().isEmpty()){
                    Toast.makeText(getApplicationContext(), "Empty Code!" , Toast.LENGTH_SHORT);
                }else{
                    Intent intent = new Intent(getApplicationContext(), seat_map.class);
                    startActivity(intent);
                }
            }
        });
    }
}
