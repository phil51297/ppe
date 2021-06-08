package com.example.ZooDorlean;

import androidx.appcompat.app.AppCompatActivity;

import android.app.SearchManager;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageButton;

public class MainActivity extends AppCompatActivity implements View.OnClickListener
        {
    private ImageButton ELEPHANT, email, facebook, insta, twitter;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        this.ELEPHANT = (ImageButton) findViewById(R.id.eletouch);
        this.ELEPHANT.setOnClickListener(this);
    }
            @Override
            public void onCancel() {

            }

            @Override
            public void onClick(View v) {
                String touch ="";
                switch (v.getId())
                {
                    case R.id.eletouch:
                        break;
            }
            Intent unIntent = new Intent (this, Inscription.class);
                unIntent.putExtra("touch", touch);
                this.startActivity(unIntent);
            }