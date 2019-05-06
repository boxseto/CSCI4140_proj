package com.example.myapplication;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

public class OrderHistory extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_order_history);

        Button backBtn = findViewById(R.id.order_history_back);

        backBtn.setOnClickListener(new Button.OnClickListener() {
            public void onClick(View v) {
                onBackPressed();
            }
        });
    }
}
