package com.example.myapplication;

import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.View;
import android.widget.Button;

public class OrderHistory extends AppCompatActivity {
    RecyclerView recyclerView;
    LinearLayoutManager layoutManager;
    ShoppingCart.ShoppingCartAdapter mAdapter;

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


        final SharedPreferences pref = (SharedPreferences) getSharedPreferences("CART", MODE_PRIVATE);
        String history = pref.getString("history", "");

        //setting recycler view
        recyclerView = (RecyclerView) findViewById(R.id.history_list);
        recyclerView.setHasFixedSize(true);

        // use a linear layout manager
        layoutManager = new LinearLayoutManager(this);
        recyclerView.setLayoutManager(layoutManager);

        // specify an adapter (see also next example)
        mAdapter = new ShoppingCart.ShoppingCartAdapter(history);
        recyclerView.setAdapter(mAdapter);
    }
}
