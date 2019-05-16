package com.example.myapplication;

import android.content.Intent;
import android.content.SharedPreferences;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.util.Pair;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;
import android.widget.TextView;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;

public class FoodMenu extends AppCompatActivity {
    RecyclerView recyclerView;
    LinearLayoutManager layoutManager;
    MyAdapter mAdapter;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_food_menu);
        final Spinner foodcourtSpinner = findViewById(R.id.foodcourtSpinner);

        Response.Listener<String> responseListener = new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try{
                    JSONObject jsonResponse  = new JSONObject(response);
                    boolean success = jsonResponse.getBoolean("success");
                    if(success){
                        //build a drop-down menu for a list of foodcourts
                        int rows = jsonResponse.getInt("rows");
                        String[] foodcourtItems = new String[rows];
                        for(int i = 0; i < rows; i++){
                            JSONObject foodcourt = jsonResponse.getJSONObject(Integer.toString(i));
                            view1.setText(foodcourt.getString("name"));
                            foodcourtItems[i] = foodcourt.getString("name");
                        }
                        ArrayAdapter<String> adapter = new ArrayAdapter<String>(getApplicationContext(),
                                android.R.layout.simple_spinner_item, foodcourtItems);
                        foodcourtSpinner.setAdapter(adapter);
                        foodcourtSpinner.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
                            @Override
                            public void onItemSelected(AdapterView<?> parent, View view,
                                                       int position, long id) {
                                //generate restaurants88\
                            }

                            @Override
                            public void onNothingSelected(AdapterView<?> parent) {
                                // TODO Auto-generated method stub
                            }
                        });


                    }else{
                        Log.i("tagconvertstr", "["+response+"]");
                    }
                }catch(JSONException e ){
                    e.printStackTrace();
                }

            }
        };
        final String FOODCOURT_REQUEST_URL = "http://4140proj.000webhostapp.com/foodcourt.php";
        StringRequest foodcourtRequest = new StringRequest(Request.Method.POST, FOODCOURT_REQUEST_URL, responseListener, null);
        RequestQueue queue = Volley.newRequestQueue(getApplicationContext());
        queue.add(foodcourtRequest);

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

        ArrayList<Pair<String, String>> myDataset = new ArrayList<Pair<String, String>>();
        myDataset.add(new Pair<String, String>("Hamburgers", "MacDonalds"));
        myDataset.add(new Pair<String, String>("Fries", "MacDonalds"));
        myDataset.add(new Pair<String, String>("Taco", "Taco Bell"));
        myDataset.add(new Pair<String, String>("Fried Rice", "Dai Pai Dong"));

        // specify an adapter (see also next example)
        mAdapter = new MyAdapter(myDataset);
        recyclerView.setAdapter(mAdapter);

    }

    public class MyAdapter extends RecyclerView.Adapter<MyAdapter.MyViewHolder> {
        private ArrayList<Pair<String, String>> mDataset;

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
        public MyAdapter(ArrayList<Pair<String, String>> myDataset) {
            mDataset = myDataset;
        }

        // Create new views (invoked by the layout manager)
        @Override
        public MyAdapter.MyViewHolder onCreateViewHolder(ViewGroup parent,
                                                         int viewType) {
            // create a new view
            View v = LayoutInflater.from(parent.getContext())
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
                    String cart = pref.getString("cart", "");
                    String item = holder.foodName.getText().toString() + ":" + holder.restaurantName.getText().toString();
                    if(cart.isEmpty()){
                        cart = item;
                    }else{
                        cart = cart + "~" + item;
                    }
                    pref.edit().putString("cart", cart).apply();
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
