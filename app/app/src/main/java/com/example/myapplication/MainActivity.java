package com.example.myapplication;

import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        Button viewSeat = (Button) findViewById(R.id.view_seat);
        Button orderFood = (Button) findViewById(R.id.order_food);
        Button orderHistory = (Button) findViewById(R.id.order_history);
        Button shoppingCart = (Button) findViewById(R.id.shopping_cart);

        viewSeat.setOnClickListener(new Button.OnClickListener() {
            public void onClick(View v) {
                Intent intent = new Intent(getApplicationContext(), QRCodeScanner.class);
                startActivity(intent);
            }
        });
        orderFood.setOnClickListener(new Button.OnClickListener() {
            public void onClick(View v) {
                SharedPreferences a = getSharedPreferences("MAP", 0);
                if(a.getString("verify", "false").contentEquals("TRUE")){
                    Intent intent = new Intent(getApplicationContext(), FoodMenu.class);
                    startActivity(intent);
                }else{
                    Toast.makeText(getApplicationContext(), "Acquire Seat via QR code first!", Toast.LENGTH_SHORT).show();
                }
            }
        });
        orderHistory.setOnClickListener(new Button.OnClickListener() {
            public void onClick(View v) {
                Intent intent = new Intent(getApplicationContext(), OrderHistory.class);
                startActivity(intent);
            }
        });
        shoppingCart.setOnClickListener(new Button.OnClickListener() {
            public void onClick(View v) {
                Intent intent = new Intent(getApplicationContext(), ShoppingCart.class);
                startActivity(intent);
            }
        });
    }
}
