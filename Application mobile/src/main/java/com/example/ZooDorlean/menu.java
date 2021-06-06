package com.example.ZooDorlean;

import androidx.appcompat.app.AppCompatActivity;

import android.app.SearchManager;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageButton;

public class menu extends AppCompatActivity implements View.OnClickListener
{
    private ImageButton animaux, activites, evenements, histoire, localisation;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_menu);
        this.animaux = (ImageButton) findViewById(R.id.animaux);
        this.activites = (ImageButton) findViewById(R.id.activites);
        this.evenements = (ImageButton) findViewById(R.id.evenements);
        this.histoire = (ImageButton) findViewById(R.id.histoire);
        this.localisation = (ImageButton) findViewById(R.id.localisation);

        this.localisation.setOnClickListener(this);
        this.animaux.setOnClickListener(this);
        this.activites.setOnClickListener(this);
        this.histoire.setOnClickListener(this);
        this.evenements.setOnClickListener(this);
    }
    @Override
    public void onClick(View v) {
        String menu ="";
        switch (v.getId())
        {
            case R.id.animaux: menu = animaux break;
            case R.id.activites: menu = activites break;
            case R.id.evenements: menu = evenements break;
            case R.id.histoire:  menu= histoire break;
            case R.id.localisation: menu=localisation break;
        }
        Intent unItent = new Intent(this, Inscription.class);
        unItent.putExtra("menu", menu);
        this.startActivity(unItent);
}