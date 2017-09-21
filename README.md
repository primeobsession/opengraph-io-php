# [Opengraph.io php](https://www.opengraph.io/)
Opengraph php package is a wrapper on opengraph specially build for php projects which is using composer to control packages.
## Usage 
* Autoload the package at the top of your php file :
```php
/**Autoload files using Composer autoload @ top of your php file where you want to use library*/

require_once __DIR__ . '/../vendor/autoload.php'; 

use OpenGraph\OpenGraph;

```
* Initiate the object with api_key from [website](https://opengraph.io/app/#!/account) and pass the site url you want to scrap :
```php
try {

    $obj = new OpenGraph('XXXXXXXXX(api_key)', 'https://some-site.com');

} catch (Exception $e) {

    echo $e->getMessage();

}
```
| Parameters   |      Required      |  Description |
|----------|:-------------:|------:|
| cache_ok |  no | This will force our servers to pull a fresh version of the site being requested. This can significantly slow down the time it takes to get a response. |
| app_id |    yes   |   The API key for registered users.  Create an account (no cc ever required) to receive your app_id. |
| full_render | no |    This will fully render the site using a chrome browser before parsing its contents. This is especially helpful for single page applications and JS redirects. This will slow down the time it takes to get a response by around 1.5 seconds. |

```php
/** cache_ok true third parameter as well as full_render is true fourth parameter both are optional**/
try {

    $obj = new OpenGraph('XXXXXXXXX(api_key)', 'https://some-site.com', true, true);

} catch (Exception $e) {

    echo $e->getMessage();

}
```
```php
/**fetch data**/

$my_data = OpenGraph::scrapSiteContents();

print_r($my_data);

```
* Response Body
```json
{
  "status": true,
  "status_code": 200,
  "response": {
    "_id": "59c287801b60710023a3b778",
    "hybridGraph": {
      "title": "On-Demand Dry Cleaning and Laundr | Dry Cleaning and Landry APP",
      "description": "On-demand dry cleaning and laundry service in New York City. Providing the best wash & fold service. Free pickup and delivery dry cleaner or download the app for IOS or Andorid to schedule your cleaning needs with a click of a button. Providing the best laundry prices in NYC, providing the best priced dry cleaning in NYC",
      "type": "site",
      "url": "https://u-rang.com",
      "favicon": "https://www.u-rang.com/public/favicon.ico",
      "site_name": "On",
      "image": "https://www.u-rang.com/public/new/img/logo-white.png"
    },
    "openGraph": {
      "error": "No OpenGraph Tags Found"
    },
    "htmlInferred": {
      "title": "On-Demand Dry Cleaning and Laundr | Dry Cleaning and Landry APP",
      "description": "On-demand dry cleaning and laundry service in New York City. Providing the best wash & fold service. Free pickup and delivery dry cleaner or download the app for IOS or Andorid to schedule your cleaning needs with a click of a button. Providing the best laundry prices in NYC, providing the best priced dry cleaning in NYC",
      "type": "site",
      "url": "https://u-rang.com",
      "favicon": "https://www.u-rang.com/public/favicon.ico",
      "site_name": "On",
      "images": [
        "https://www.u-rang.com/public/new/img/logo-white.png",
        "https://www.u-rang.com/public/new/img/logo.png",
        "https://www.u-rang.com/public/new/img/mobileapp-mytrip.jpg",
        "https://play.google.com/intl/en_us/badges/images/generic/en_badge_web_generic.png",
        "https://www.u-rang.com/public/new/img/mobile-app/appstore.png",
        "https://www.u-rang.com/public/new/img/laptop.jpg",
        "https://www.u-rang.com/public/new/img/content-logo.png",
        "https://loiseaufait.files.wordpress.com/2013/09/weheartny_blog_700x500.jpg",
        "https://www.u-rang.com/public/new/img/img1.jpg",
        "https://www.u-rang.com/public/new/img/img2.jpg",
        "https://www.u-rang.com/public/new/img/img3.jpg",
        "https://www.u-rang.com/public/new/img/img4.jpg",
        "https://www.u-rang.com/public/new/img/img5.jpg",
        "https://www.u-rang.com/public/new/img/img6.jpg",
        "https://www.u-rang.com/public/new/img/img7.jpg",
        "https://www.u-rang.com/public/new/img/img8.jpg",
        "https://www.u-rang.com/public/new/img/img9.jpg",
        "https://www.u-rang.com/public/new/img/img10.jpg",
        "https://www.u-rang.com/public/new/img/img11.jpg",
        "https://www.u-rang.com/public/new/img/img12.jpg",
        "https://www.u-rang.com/public/new/img/img13.jpg",
        "https://www.u-rang.com/public/new/img/img14.jpg",
        "https://www.u-rang.com/public/new/img/img15.jpg",
        "https://www.u-rang.com/public/new/img/img16.jpg",
        "https://www.u-rang.com/public/new/img/browsers-image.png"
      ],
      "image_guess": "https://www.u-rang.com/public/new/img/logo-white.png"
    },
    "url": "https://u-rang.com",
    "__v": 0,
    "requestInfo": {
      "redirects": 0,
      "host": "https://www.u-rang.com/"
    },
    "accessed": 22,
    "updated": "2017-09-21T12:44:44.938Z",
    "created": "2017-09-20T15:21:36.614Z",
    "version": "1.1"
  }
}
```
here response keyowrd in that json object holds the actual output.
* Several other methods which can make your life easy 
```php
/**get the site title**/

$getTitle = OpenGraph::getTitle(json_encode(json_decode($my_data)->response));

```
`NOTE : If you want you can the response obj as json as well as array`
```php
/** as json **/

$getTitle = OpenGraph::getTitle(json_encode(json_decode($my_data)->response));

/** as array **/

$getTitle =  OpenGraph::getTitle(json_decode($my_data)->response, true);

```
# More Examples :
### Get Site Description :
```php
try {
    /**pass response obj as an json**/

    $getDescription = OpenGraph::getDescription(json_encode(json_decode($my_data)->response));

    print_r($getDescription);

} catch(Exception $e) {

        echo $e->getMessage();
}
```
or
```php
try {
    /**pass response obj as an array**/

    $getDescription = OpenGraph::getDescription(json_decode($my_data)->response, true);

    print_r($getDescription);

} catch(Exception $e) {

    echo $e->getMessage();

}
```
### Get Image Logo :
```php
/**as a json**/

$getImage = OpenGraph::getImage(json_encode(json_decode($my_data)->response));
```
or
```php
/**as an array**/

$getImageArr = OpenGraph::getImage(json_decode($my_data)->response, true);

```
