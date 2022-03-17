package com.example.myapplication

import android.content.*
import androidx.appcompat.app.*
import android.os.Bundle
import android.widget.*

class MainActivity : AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        val usertxt: TextView = findViewById(R.id.txtUser)
        val txttitl: TextView = findViewById(R.id.txttitl)
        val btnlogout:Button=findViewById(R.id.btnlogout)


        val nom = intent.getStringExtra("UserName")

        if (nom != null) usertxt.text = nom;
        else startActivity(Intent(this@MainActivity, LoginActivity::class.java))

        btnlogout.setOnClickListener{
            finish()
        }
    }

}