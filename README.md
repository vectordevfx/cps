![logo CPS](https://raw.githubusercontent.com/vectordevfx/cps/master/images/cps-logo.png)

# Welcome to CPS!

CPS (Calculate Performance Score) is designed to let you keep track of your website overall performance optimisation scores. Get insight into your scores and start improving. Currently supporting 1 page. Preloaded with 10 different service providers (keeping track of 17 scores). You can easily add, remove or deactivate any service provider.

## Screenshots
![logo CPS](https://raw.githubusercontent.com/vectordevfx/cps/master/images/light_theme1.png)
![logo CPS](https://raw.githubusercontent.com/vectordevfx/cps/master/images/dark_theme2.png)
## Requirements

PHP 5.5+**

## Installation

Download and run on your server.

## Configuration

The file `include/data.json` contains everything you need to get started. 
Open it up with your favorite text editor and start editing!

JSON Object Overview

|     key         |value description		    |Example                        |
|----------------|-------------------------------|-----------------------------|
|title		|title of service provider           |Google PageSpeed Insights Desktop            |
|description    |small description about your service provider |Analyze with PageSpeed Insights Desktop. Get your PageSpeed score and use PageSpeed suggestions to make your web site faster through our online tool.            |
|picture	|logo url	|images/google-page-speed-insights.png|
|link		|website url	|https://developers.google.com/speed/pagespeed/insights/|
|active		|boolean	|true|
|fields		|array describing the service|Desktop|
|value		|your score|100|


The above example would look like this:
```
    {
    	"title": "Google PageSpeed Insights Desktop",
    	"description": "Analyze with PageSpeed Insights Desktop. Get your PageSpeed score and use 
    	PageSpeed suggestions to make your web site faster through our online tool.",
    	"picture": "images/google-page-speed-insights.png",
    	"link": "https://developers.google.com/speed/pagespeed/insights/",
    	"active": true,
    	"fields": [
    	"Desktop"
    	],
    	"value": [
    	100 ]
    }
```

One more example, now with a service provider offering multiple "services".
The key fields holds an array which correspond with the key value.

Performance -> 50

Accessibility -> 19

Best Practices -> 21

SEO -> 20


```
    {
    "title": "Google Lighthouse Desktop",
    "description": "Lighthouse is an open-source, automated tool for improving the quality of web pages. You can run it against any web page, public or requiring authentication. It has audits for performance, accessibility, progressive web apps, and more.",
    "picture": "images/google-lighthouse.png",
    "link": "https://developers.google.com/web/tools/lighthouse/",
	"active": true,
    "fields": [
      "Performance",
      "Accessibility",
      "Best Practices",
      "SEO"
    ],
    "value": [
      50,
      19,
      21,
      20
    ]
  }
```

## How to switch a service provider off?
Easily turn off one or more service providers by changing the JSON object key "active" to false.

## What if a service provider provides an alphabetic rating such as A?
No problem! At the moment we assign the following values..

A+ = 100

A = 80

B = 60

C = 40

D = 20

E = 0

Not happy about it? 

open index.php and look for the `$arrayAlpha` and change the values.  


## Preloaded service providers
 - Google PageSpeed Insights Desktop
 - Google PageSpeed Insights Mobile
 - Google Lighthouse Desktop
	(Performance,
	Accessibility,
	Best Practices,
	SEO)
 - Google Lighthouse Mobile
	(Performance,
	Accessibility,
	Best Practices,
	SEO)
 - HIGH-TECH BRIDGE
	(SSL Security,
	Website Security)
 - Qualys SSL Labs
 - Gift of Speed
 - Pingdom
 - GTmetrix
 - Virustotal
