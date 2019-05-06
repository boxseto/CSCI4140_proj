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

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.List;

public class FoodMenu extends AppCompatActivity {
    RecyclerView recyclerView;
    LinearLayoutManager layoutManager;
    MyAdapter mAdapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_food_menu);

        //setting back button
        Button backBtn = findViewById(R.id.food_menu_back);
        backBtn.setOnClickListener(new Button.OnClickListener() {
            public void onClick(View v) {
                onBackPressed();
            }
        });
        

        //setting recycler view
        recyclerView = (RecyclerView) findViewById(R.id.food_menu);
        recyclerView.setHasFixedSize(true);

        // use a linear layout manager
        layoutManager = new LinearLayoutManager(this);
        recyclerView.setLayoutManager(layoutManager);

        List<Pair<String, String>> myDataset = null;

        // specify an adapter (see also next example)
        mAdapter = new MyAdapter(myDataset);
        recyclerView.setAdapter(mAdapter);

    }

    public class MyAdapter extends RecyclerView.Adapter<MyAdapter.MyViewHolder> {
        private List<Pair<String, String>> mDataset;

        // Provide a reference to the views for each data item
        // Complex data items may need more than one view per item, and
        // you provide access to all the views for a data item in a view holder
        public class MyViewHolder extends RecyclerView.ViewHolder {
            // each data item is just a string in this case
            public TextView foodName;
            public TextView restaurantName;
            public Button addBtn;
            public MyViewHolder(View v) {
                super(v);
                foodName = v.findViewById(R.id.item_food_name);
                restaurantName = v.findViewById(R.id.item_food_restaurant);
                addBtn = v.findViewById(R.id.food_item_add);
            }
        }

        // Provide a suitable constructor (depends on the kind of dataset)
        public MyAdapter(List<Pair<String, String>> myDataset) {
            mDataset = myDataset;
        }

        // Create new views (invoked by the layout manager)
        @Override
        public MyAdapter.MyViewHolder onCreateViewHolder(ViewGroup parent,
                                                         int viewType) {
            // create a new view
            View v = (TextView) LayoutInflater.from(parent.getContext())
                    .inflate(R.layout.food_menu_list_item, parent, false);
            MyViewHolder vh = new MyViewHolder(v);
            return vh;
        }

        // Replace the contents of a view (invoked by the layout manager)
        @Override
        public void onBindViewHolder(final MyViewHolder holder, int position) {
            holder.foodName.setText(mDataset.get(position).first);
            holder.restaurantName.setText(mDataset.get(position).second);
            holder.addBtn.setOnClickListener(new Button.OnClickListener() {
                public void onClick(View v) {
                    SharedPreferences pref = (SharedPreferences) getSharedPreferences("CART", MODE_PRIVATE);
                    String raw = pref.getString("cart", "{}");
                    try{
                        JSONArray array = new JSONArray(raw);
                        JSONObject appendobj = new JSONObject();
                        appendobj.put("name", holder.foodName.getText());
//                        array.add(appendobj);
                    }
                    catch(JSONException e) {
                        e.printStackTrace();
                    }
                }
            });
        }

        // Return the size of your dataset (invoked by the layout manager)
        @Override
        public int getItemCount() {
            return mDataset.size();
        }
    }

}
