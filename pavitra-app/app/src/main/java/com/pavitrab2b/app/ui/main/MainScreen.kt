package com.pavitrab2b.app.ui.main

import android.content.Context
import android.webkit.WebResourceError
import android.webkit.WebResourceRequest
import android.webkit.WebView
import android.webkit.WebViewClient
import android.webkit.WebSettings
import com.pavitrab2b.app.BuildConfig
import androidx.activity.compose.BackHandler
import androidx.compose.foundation.background
import androidx.compose.foundation.layout.Arrangement
import androidx.compose.foundation.layout.Box
import androidx.compose.foundation.layout.systemBarsPadding
import androidx.compose.foundation.layout.Column
import androidx.compose.foundation.layout.Row
import androidx.compose.foundation.layout.Spacer
import androidx.compose.foundation.layout.fillMaxSize
import androidx.compose.foundation.layout.fillMaxWidth
import androidx.compose.foundation.layout.height
import androidx.compose.foundation.layout.padding
import androidx.compose.foundation.layout.size
import androidx.compose.foundation.layout.width
import androidx.compose.foundation.shape.RoundedCornerShape
import androidx.compose.material3.Button
import androidx.compose.material3.ButtonDefaults
import androidx.compose.material3.Card
import androidx.compose.material3.CardDefaults
import androidx.compose.material3.CircularProgressIndicator
import androidx.compose.material3.OutlinedButton
import androidx.compose.material3.OutlinedTextField
import androidx.compose.material3.Text
import androidx.compose.runtime.Composable
import androidx.compose.runtime.getValue
import androidx.compose.runtime.mutableStateOf
import androidx.compose.runtime.remember
import androidx.compose.runtime.setValue
import androidx.compose.ui.Alignment
import androidx.compose.ui.Modifier
import androidx.compose.ui.graphics.Brush
import androidx.compose.ui.graphics.Color
import androidx.compose.ui.platform.LocalContext
import androidx.compose.ui.text.font.FontWeight
import androidx.compose.ui.text.style.TextAlign
import androidx.compose.ui.unit.dp
import androidx.compose.ui.unit.sp
import androidx.compose.ui.viewinterop.AndroidView
import androidx.navigation3.runtime.NavKey

@Composable
fun MainScreen(
  onItemClick: (NavKey) -> Unit,
  modifier: Modifier = Modifier,
) {
  val context = LocalContext.current
  val prefs = remember { context.getSharedPreferences("pavitra_prefs", Context.MODE_PRIVATE) }
  
  val isOfflineMode = BuildConfig.OFFLINE_MODE
  val offlineUrl = "file:///android_asset/index.html"
  
  val storedUrl = prefs.getString("server_url", null)
  val defaultUrl = "https://arts-diffs-prepare-mall.trycloudflare.com/"
  
  val activeUrl = if (isOfflineMode) {
    offlineUrl
  } else if (storedUrl != null && storedUrl.contains(".loca.lt")) {
    prefs.edit().putString("server_url", defaultUrl).apply()
    defaultUrl
  } else {
    storedUrl ?: defaultUrl
  }
  
  var savedUrl by remember { mutableStateOf(activeUrl) }
  var webViewInstance by remember { mutableStateOf<WebView?>(null) }
  
  var isLoading by remember { mutableStateOf(true) }
  var loadError by remember { mutableStateOf(false) }
  var showSettings by remember { mutableStateOf(if (isOfflineMode) false else false) }
  var inputUrl by remember { mutableStateOf(activeUrl) }

  val bypassHeaders = remember { if (isOfflineMode) emptyMap() else mapOf("Bypass-Tunnel-Reminder" to "true") }

  BackHandler(enabled = (webViewInstance?.canGoBack() == true) && !loadError && !showSettings) {
    webViewInstance?.goBack()
  }

  Box(modifier = Modifier.fillMaxSize().systemBarsPadding()) {
    // 1. WebView Layer (only active when savedUrl is configured)
    if (savedUrl.isNotEmpty()) {
      AndroidView(
        factory = { ctx ->
          WebView(ctx).apply {
            layoutParams = android.view.ViewGroup.LayoutParams(
              android.view.ViewGroup.LayoutParams.MATCH_PARENT,
              android.view.ViewGroup.LayoutParams.MATCH_PARENT
            )
            webViewClient = object : WebViewClient() {
              override fun onPageStarted(view: WebView?, url: String?, favicon: android.graphics.Bitmap?) {
                super.onPageStarted(view, url, favicon)
                if (!loadError) {
                  isLoading = true
                }
              }

              override fun onPageFinished(view: WebView?, url: String?) {
                super.onPageFinished(view, url)
                if (!loadError) {
                  isLoading = false
                }
              }

              override fun onReceivedError(
                view: WebView?,
                errorCode: Int,
                description: String?,
                failingUrl: String?
              ) {
                super.onReceivedError(view, errorCode, description, failingUrl)
                loadError = true
                isLoading = false
              }

              override fun onReceivedError(
                view: WebView?,
                request: WebResourceRequest?,
                error: WebResourceError?
              ) {
                super.onReceivedError(view, request, error)
                if (request?.isForMainFrame == true) {
                  loadError = true
                  isLoading = false
                }
              }
            }
            settings.apply {
              javaScriptEnabled = true
              domStorageEnabled = true
              databaseEnabled = true
              mixedContentMode = WebSettings.MIXED_CONTENT_ALWAYS_ALLOW
              userAgentString = "PavitraB2B-Android-APK"
              useWideViewPort = true
              loadWithOverviewMode = true
              allowFileAccess = true
            }
            if (isOfflineMode) {
              loadUrl(savedUrl)
            } else {
              loadUrl(savedUrl, bypassHeaders)
            }
            webViewInstance = this
          }
        },
        modifier = Modifier.fillMaxSize(),
        update = {
          webViewInstance = it
        }
      )
    }

    // 2. Loading / Splash Screen Overlay (Pavitra Inspired)
    if (isLoading && !loadError && !showSettings) {
      Column(
        modifier = Modifier
          .fillMaxSize()
          .background(Color.White),
        horizontalAlignment = Alignment.CenterHorizontally,
        verticalArrangement = Arrangement.SpaceBetween
      ) {
        Spacer(modifier = Modifier.height(40.dp))

        Column(
          horizontalAlignment = Alignment.CenterHorizontally,
          verticalArrangement = Arrangement.Center
        ) {
          Box(
            modifier = Modifier
              .size(80.dp)
              .background(
                brush = Brush.linearGradient(
                  colors = listOf(Color(0xFF482922), Color(0xFF1c1c1c))
                ),
                shape = RoundedCornerShape(20.dp)
              ),
            contentAlignment = Alignment.Center
          ) {
            Text(
              text = "\u092a",
              color = Color.White,
              fontSize = 38.sp,
              fontWeight = FontWeight.Bold
            )
          }

          Spacer(modifier = Modifier.height(20.dp))

          Text(
            text = "Pavitra B2B",
            fontSize = 24.sp,
            fontWeight = FontWeight.ExtraBold,
            color = Color(0xFF212529),
            letterSpacing = 0.5.sp
          )

          Text(
            text = "Weavers to Retailers Marketplace",
            fontSize = 13.sp,
            color = Color(0xFF868E96),
            modifier = Modifier.padding(top = 4.dp)
          )

          Spacer(modifier = Modifier.height(40.dp))

          CircularProgressIndicator(
            color = Color(0xFF482922),
            strokeWidth = 3.dp,
            modifier = Modifier.size(28.dp)
          )
        }

        Column(
          horizontalAlignment = Alignment.CenterHorizontally,
          modifier = Modifier.padding(bottom = 40.dp)
        ) {
          Text(
            text = "Connecting to server...",
            fontSize = 12.sp,
            color = Color(0xFF868E96)
          )
          Text(
            text = "URL: $savedUrl",
            fontSize = 10.sp,
            color = Color(0xFFADB5BD),
            modifier = Modifier.padding(top = 2.dp)
          )
        }
      }
    }

    // 3. Setup / Error Page Overlay
    if (loadError || showSettings) {
      Box(
        modifier = Modifier
          .fillMaxSize()
          .background(Color(0xFFF8F9FA))
          .padding(24.dp),
        contentAlignment = Alignment.Center
      ) {
        Card(
          colors = CardDefaults.cardColors(containerColor = Color.White),
          elevation = CardDefaults.cardElevation(defaultElevation = 6.dp),
          shape = RoundedCornerShape(16.dp),
          modifier = Modifier.fillMaxWidth()
        ) {
          Column(
            modifier = Modifier.padding(24.dp),
            horizontalAlignment = Alignment.CenterHorizontally
          ) {
            Box(
              modifier = Modifier
                .size(56.dp)
                .background(Color(0xFFFFF0F6), shape = RoundedCornerShape(28.dp)),
              contentAlignment = Alignment.Center
            ) {
              Text("🌐", fontSize = 24.sp)
            }

            Spacer(modifier = Modifier.height(16.dp))

            Text(
              text = if (loadError) "Connection Offline" else "Server Configuration",
              fontSize = 20.sp,
              fontWeight = FontWeight.Bold,
              color = if (loadError) Color(0xFFC92A2A) else Color(0xFF212529)
            )
            
            Spacer(modifier = Modifier.height(8.dp))
            
            Text(
              text = if (loadError) "Could not connect to the B2B store. Please check your internet connection and try again." else "Configure the base URL of your Pavitra development or production server. The default is set to our demo public tunnel.",
              fontSize = if (loadError) 13.sp else 12.sp,
              color = Color(0xFF495057),
              textAlign = TextAlign.Center,
              lineHeight = if (loadError) 18.sp else 16.sp
            )
            
            if (showSettings) {
              Spacer(modifier = Modifier.height(20.dp))
              
              OutlinedTextField(
                value = inputUrl,
                onValueChange = { inputUrl = it },
                label = { Text("Server Base URL") },
                placeholder = { Text("e.g. https://myb2bmarket.com/") },
                singleLine = true,
                shape = RoundedCornerShape(8.dp),
                modifier = Modifier.fillMaxWidth()
              )
              
              Spacer(modifier = Modifier.height(12.dp))

              Card(
                colors = CardDefaults.cardColors(containerColor = Color(0xFFFFF9DB)),
                modifier = Modifier.fillMaxWidth()
              ) {
                Column(modifier = Modifier.padding(12.dp)) {
                  Text(
                    text = "💡 Server Guide:",
                    fontSize = 11.sp,
                    fontWeight = FontWeight.Bold,
                    color = Color(0xFFF59F00)
                  )
                  Text(
                    text = "Enter any HTTP/HTTPS server address. If using our local developer setup, simply hit Connect to use the pre-populated demo Localtunnel link.",
                    fontSize = 10.sp,
                    color = Color(0xFF66A80F),
                    lineHeight = 14.sp,
                    modifier = Modifier.padding(top = 2.dp)
                  )
                }
              }

              Spacer(modifier = Modifier.height(24.dp))
              
              Button(
                onClick = {
                  var finalUrl = inputUrl.trim()
                  if (!finalUrl.startsWith("http://") && !finalUrl.startsWith("https://")) {
                    finalUrl = "http://$finalUrl"
                  }
                  if (!finalUrl.endsWith("/")) {
                    finalUrl = "$finalUrl/"
                  }
                  
                  prefs.edit().putString("server_url", finalUrl).apply()
                  savedUrl = finalUrl
                  inputUrl = finalUrl
                  loadError = false
                  showSettings = false
                  isLoading = true
                  
                  if (webViewInstance != null) {
                    webViewInstance?.loadUrl(finalUrl, bypassHeaders)
                  }
                },
                colors = ButtonDefaults.buttonColors(containerColor = Color(0xFF482922)),
                shape = RoundedCornerShape(8.dp),
                modifier = Modifier
                  .fillMaxWidth()
                  .height(48.dp)
              ) {
                Text("Connect & Save", fontWeight = FontWeight.Bold, fontSize = 14.sp)
              }
            }
            
            if (showSettings && storedUrl != null) {
              Spacer(modifier = Modifier.height(8.dp))
              
              Button(
                onClick = {
                  showSettings = false
                },
                colors = ButtonDefaults.buttonColors(containerColor = Color.Transparent, contentColor = Color(0xFF868E96)),
                modifier = Modifier.fillMaxWidth()
              ) {
                Text("Cancel", fontWeight = FontWeight.Medium)
              }
            } else if (savedUrl.isNotEmpty() && !showSettings) {
              Spacer(modifier = Modifier.height(24.dp))
              
              Button(
                onClick = {
                  loadError = false
                  isLoading = true
                  webViewInstance?.loadUrl(savedUrl, bypassHeaders)
                },
                colors = ButtonDefaults.buttonColors(containerColor = Color(0xFF482922)),
                shape = RoundedCornerShape(8.dp),
                modifier = Modifier
                  .fillMaxWidth()
                  .height(48.dp)
              ) {
                Text("Retry Connection", fontWeight = FontWeight.Bold, fontSize = 14.sp)
              }
            }
          }
        }
      }
    }
  }
}
