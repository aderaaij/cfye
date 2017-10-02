<?php
/**
 * The index, found at the bottom of our waterfall
 * Borrowed mostly from the TwentyTwelve theme
 * The template hierarchy Cheat sheet: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage cfye
 * @since cfye 0.1
 */

get_header(); ?>


<?php
	// Pull articles location variable directly from DB (declared in functions.php)
	$article_location = get_meta_values( 'add_location' );
	
	// Better alternative: Store a wp_query in the '$post_data' array
	$args = array(
			'post_type' => 'artists',
			'posts_per_page' => -1
		); 
	$query = new WP_Query($args);
	//start query
	if ( $query->have_posts() ) {
	    while ( $query->have_posts() ) {
	        $query->the_post();  
	        // if the article location is filled in (ACF), this is a map option after all      
	        if(get_field('artist_location')):
	        //get post thumbnail url
	        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'thumbnail' );
			$url = $thumb[0];
			// This is the data that will be stored in the array
	        $post_data[] = array(
	           get_field('artist_location'), 
	           get_the_title(),
	           $url,
	           get_permalink()
	        );
	    	endif;
	    }
	}
	//echo "var json=". json_encode($post_data);
?>

<?php // echo json_encode($my_var) ?>

<script type="text/javascript">	
	//declare vars	
	var 
		//Parse php arrays into JSON - Article location objects
		mapsObj = JSON.parse('<?php echo json_encode($article_location) ?>'),
		//Parse php arrays into JSON - Artist location objects
		artistMap = JSON.parse('<?php echo json_encode($post_data) ?>'),	
		// Declare map variable for google maps
		map;
		//Initialize Google Maps function
	function initialize() {
		//declare variables within function
		var 
			//declare gm shortname for google.maps, just to be quick
			gm = google.maps,
			// add custom styling options
			cfye_map = 'custom_style',
			// set default homebase
			home = new gm.LatLng(47.383474,4.746094),
			//set global map options
			options = {
				'zoom': 1,				
				'minZoom': 1,
				'mapTypeId': cfye_map
			},
			//create new map instance
			map = new gm.Map(document.getElementById('map'), options),		
			// an array for all the markes after the marker loop
			allMarkers = [],
			//Bounds?
			bounds = new gm.LatLngBounds(),
			// create a new infoWindow for the markers
			infoWindow = new gm.InfoWindow(),
			//Spiderfier Function - https://github.com/jawj/OverlappingMarkerSpiderfier
			oms = new OverlappingMarkerSpiderfier(map, {markersWontMove: true, markersWontHide: true, keepSpiderfied: true}),
			// Create new infowindow for Spiderfier
			iw = new gm.InfoWindow();
		// Add global click listener for Spiderfier	
		oms.addListener('click', function(marker, event) {
			iw.setContent(marker.desc);
			iw.open(map, marker);
		});
				
		// Loop through map objects in case of Article locations
		/*for (var i in mapsObj){	  	
			if(mapsObj[i]) {
				//console.log(mapsObj[i]);
				// split the map object at pipe (|)
				var splitMapsObj = mapsObj[i].split("|");
				//console.log(splitMapsObj);
				//Split latitude and longitude
				var splitLatLng = splitMapsObj[1].split(",");
				//declare lat and long
				var wpLat = splitLatLng[0];
				var wpLng = splitLatLng[1];
				var wpLatLng = new gm.LatLng(wpLat, wpLng);
				var wpLocation = splitMapsObj[0];
				var content = '<div class="map-content"><span>' + wpLocation + '</span></div>';			   
				var marker = new gm.Marker({
					map: map,
					title: wpLocation,
					position: wpLatLng				   
				});
				// Add markers to Spiderfier
				oms.addMarker(marker);
							  
				gm.event.addListener(marker, 'click', (function(marker, content) {
					return function() {
						infoWindow.setContent(content);
						infoWindow.open(map, marker);
					}
				})(marker, content));
				
				//push marker into allMarkers array
				allMarkers.push(marker);
			}			
		}*/
		// Create variable to store all map objects in after the loop
		
		// loop through the array of artist information
		for (var i in artistMap){	  	
			if(artistMap[i]) {
				//put each array in a location variable
				var 
					location = artistMap[i],
					// split array at comma
					splitArtistMap = location[0].split(","),				
					// The artist name
					artistName = location[1],
					// The artists thumbnail url
					thumbUrl = location[2],
					// The artists URL
					artistLink = location[3],
					//declare lat and long
					artistWpLat = splitArtistMap[0],
					artistWpLng = splitArtistMap[1],
					artistWpLatLng = new gm.LatLng(artistWpLat, artistWpLng),
					//create marker content		
					content = '<a href="' + artistLink + '" title="' + artistName + '"> <h3 class="artist-map-title">' + artistName + '</h3><img class= "map-artist-thumb" src="' + thumbUrl + '"/></a>',
					//create markers
					marker = new gm.Marker({
						map: map,
						title: artistName,
						position: artistWpLatLng				   
					});
				// Add markers to Spiderfier
				oms.addMarker(marker);
				// add a listener for each marker click						  
				gm.event.addListener(marker, 'click', (function(marker, content) {
					return function() {
						infoWindow.setContent(content);
						infoWindow.open(map, marker);
					}
				})(marker, content));				
				//push marker into allMarkers array created before the loop
				allMarkers.push(marker);
			}			
		}
		// Start markercluster (needs to be declared after the foreach, makes use of the 'allMarkers' array)
		var mcOptions = {maxZoom: 9, center:home};
		var mc = new MarkerClusterer(map, allMarkers, mcOptions);
		
		// set bounds ?
				
		map.fitBounds(bounds);
		
		//Set featured options to stylize map
		// http://gmaps-samples-v3.googlecode.com/svn/trunk/styledmaps/wizard/index.html
		var featureOpts = [
			{
    			"featureType": "administrative.country",
    			"stylers": [
      				{ "visibility": "off" }
    			]
  			},{
    			"stylers": [
      				{ "saturation": 26 },
      				{ "lightness": 7 },
      				{ "gamma": 0.74 }
    			]
  			},{	
    			"featureType": "administrative",
    			"stylers": [
      				{ "visibility": "off" }
    			]
  			},{
    		"featureType": "water",
    			"stylers": [
      				{ "visibility": "on" }
    			]
  			},{
    			"featureType": "administrative.locality",
    			"stylers": [
      				{ "visibility": "on" }
    			]
  			},{
    			"featureType": "road",
    			"stylers": [
      				{ "visibility": "simplified" }
    			]
  			},{
    			"featureType": "poi",
    			"elementType": "labels",
    			"stylers": [
      				{ "visibility": "simplified" }
    			]
  			},{
    			"featureType": "road.highway",
    			"stylers": [
      				{ "visibility": "off" }
    			]
  			},{
    			"featureType": "administrative.country",
    			"elementType": "labels.text",
    			"stylers": [
      				{ "visibility": "on" }
    			]
  			}
		];		
		//name the styled map option
		var styledMapOptions = {
			name: 'grayscale',
			minZoom: 1,
			center: home
			//controlPosition: 'BOTTOM_RIGHT'
		};		
		// declare custom map type variable with the featured options and styled map options
		var customMapType = new gm.StyledMapType(featureOpts, styledMapOptions);		
		// Set map to custom maptype
		map.mapTypes.set(cfye_map, customMapType);	
		// event listener
		var listener = gm.event.addListener(map, "idle", function () {
			map.setZoom(3);			
			map.setCenter(home);
			gm.event.removeListener(listener);
		});

	}
	google.maps.event.addDomListener(window, 'load', initialize);
	/*create a function to load the Google Maps V3 api and append it to the body(footer) after load ()
	function loadScript() {
		var script = document.createElement('script');
		script.type = 'text/javascript';
		//load api + callback functionname
		script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' + 'callback=initialize';
		document.body.appendChild(script);		
	}	
	window.onload = loadScript();*/
</script>
			
<div id="map" class="explore-map" ></div>


		
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php the_content();?>
	<?php endwhile; endif;?>
	
<?php get_footer(); ?>