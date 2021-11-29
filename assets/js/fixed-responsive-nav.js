/* =============================================
 *
 *   FIXED RESPONSIVE NAV
 *
 *   (c) 2014 @adtileHQ
 *   http://www.adtile.me
 *   http://twitter.com/adtilehq
 *
 *   Free to use under the MIT License.
 *
 * ============================================= */

(function () {


  const menu_items = document.querySelector('.show');
  menu_items.classList.toggle('menu_items');

  // Feature test to rule out some older browsers
  if ("querySelector" in document && "addEventListener" in window) {


    // Find navigation links and save a reference to them
    var nav = document.querySelector(".menu ul"),
      links = nav.querySelectorAll("[data-scroll]");

    // "content" will store all the location cordinates
    var content;

    // Set up an array of locations which we store in "content"
    var setupLocations = function () {
      content = [];
      forEach(links, function (i, el) {
        var href = links[i].getAttribute("href").replace("#", "");
        content.push(document.getElementById(href).offsetTop + 200);

      });
    };

    // call locations set up once
    setupLocations();
  }
})
