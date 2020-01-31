// Run in Chrome Web Developer Tool Console:
var siteURL = "http://" + top.location.host.toString();

urls = $$("a[href^='"+siteURL+"'], a[href^='/'], a[href^='./'], a[href^='../'], a[href^='#']"); for (url in urls) console.log ( urls[url].href );
