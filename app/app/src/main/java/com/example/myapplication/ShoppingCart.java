package com.example.myapplication;

import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Pair;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.TextView;

import java.util.ArrayList;


public class ShoppingCart extends AppCompatActivity {
    RecyclerView recyclerView;
    LinearLayoutManager layoutManager;
    ShoppingCartAdapter mAdapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_shopping_cart);

        Button backBtn = findViewById(R.id.shopping_cart_back);
        Button checkoutBtn = findViewById(R.id.shopping_cart_pay);

        final SharedPreferences pref = (SharedPreferences) getSharedPreferences("CART", MODE_PRIVATE);
        String cart = pref.getString("cart", "");


        backBtn.setOnClickListener(new Button.OnClickListener() {
            public void onClick(View v) {
                onBackPressed();
            }
        });
        checkoutBtn.setOnClickListener(new Button.OnClickListener() {
            public void onClick(View v) {
                String history = pref.getString("history", "");
                String currentCart = pref.getString("cart", "");
                if(!currentCart.isEmpty()){
                    if(history.isEmpty()){
                        history = currentCart;
                    }else{
                        history = history + "~" +  currentCart;
                    }
                    pref.edit()
                            .putString("history", history)
                            .putString("cart", "")
                            .apply();
                }
                mAdapter.clear();
            }
        });


        //setting recycler view
        recyclerView = (RecyclerView) findViewById(R.id.shopping_cart_list);
        recyclerView.setHasFixedSize(true);

        // use a linear layout manager
        layoutManager = new LinearLayoutManager(this);
        recyclerView.setLayoutManager(layoutManager);

        // specify an adapter (see also next example)
        mAdapter = new ShoppingCartAdapter(cart);
        recyclerView.setAdapter(mAdapter);
    }

    public static class ShoppingCartAdapter extends RecyclerView.Adapter<ShoppingCart.ShoppingCartAdapter.CartViewHolder> {
        private ArrayList<Pair<String, String>> mDataset = new ArrayList<Pair<String, String>>();

        // Provide a reference to the views for each data item
        // Complex data items may need more than one view per item, and
        // you provide access to all the views for a data item in a view holder
        public class CartViewHolder extends RecyclerView.ViewHolder {
            // each data item is just a string in this case
            public TextView foodName;
            public TextView restaurantName;
            public CartViewHolder(View v) {
                super(v);
                foodName = v.findViewById(R.id.cart_food_name);
                restaurantName = v.findViewById(R.id.cart_food_restaurant);
            }
        }

        // Provide a suitable constructor (depends on the kind of dataset)
        public ShoppingCartAdapter(String myDataset) {
            if(!myDataset.isEmpty()){
                String[] items = myDataset.split("~");
                for(String item : items){
                    String[] temp = item.split(":");
                    mDataset.add(new Pair<String, String>(temp[0], temp[1]));
                }
            }
        }

        // Create new views (invoked by the layout manager)
        @Override
        public ShoppingCartAdapter.CartViewHolder onCreateViewHolder(ViewGroup parent,
                                                                  int viewType) {
            // create a new view
            View v = LayoutInflater.from(parent.getContext())
                    .inflate(R.layout.shopping_cart_list_item, parent, false);
            CartViewHolder vh = new CartViewHolder(v);
            return vh;
        }

        // Replace the contents of a view (invoked by the layout manager)
        @Override
        public void onBindViewHolder(final ShoppingCart.ShoppingCartAdapter.CartViewHolder holder, int position) {
            holder.foodName.setText(mDataset.get(position).first);
            holder.restaurantName.setText(mDataset.get(position).second);
        }

        // Return the size of your dataset (invoked by the layout manager)
        @Override
        public int getItemCount() {
            if(mDataset == null){
                return 0;
            }else{
                return mDataset.size();
            }
        }

        public void clear() {
            int size = mDataset.size();
            if (size > 0) {
                for (int i = 0; i < size; i++) {
                    mDataset.remove(0);
                }
                notifyItemRangeRemoved(0, size);
            }
        }
    }
}
