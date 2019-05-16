materialKitDemo = {

  initContactUsMap: function(){
      var myLatlng = new google.maps.LatLng(44.433530, 26.093928);
      var mapOptions = {
        zoom: 14,
        center: myLatlng,
        styles:
[{"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}],
        scrollwheel: false, //we disable de scroll over the map, it is a really annoing when you scroll through page
     };
      var map = new google.maps.Map(document.getElementById("contactUsMap"), mapOptions);

      var marker = new google.maps.Marker({
          position: myLatlng,
          title:"Hello World!"
      });
      marker.setMap(map);
  },

  initContactUs2Map: function(){
      var lat = 44.433530;
      var long = 26.093928;

      var centerLong = long - 0.025;

      var myLatlng = new google.maps.LatLng(lat,long);
      var centerPosition = new google.maps.LatLng(lat, centerLong);

      var mapOptions = {
        zoom: 14,
        center: centerPosition,
        styles:
[{"featureType":"water","stylers":[{"saturation":43},{"lightness":-11},{"hue":"#0088ff"}]},{"featureType":"road","elementType":"geometry.fill","stylers":[{"hue":"#ff0000"},{"saturation":-100},{"lightness":99}]},{"featureType":"road","elementType":"geometry.stroke","stylers":[{"color":"#808080"},{"lightness":54}]},{"featureType":"landscape.man_made","elementType":"geometry.fill","stylers":[{"color":"#ece2d9"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#ccdca1"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#767676"}]},{"featureType":"road","elementType":"labels.text.stroke","stylers":[{"color":"#ffffff"}]},{"featureType":"poi","stylers":[{"visibility":"off"}]},{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#b8cb93"}]},{"featureType":"poi.park","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","stylers":[{"visibility":"simplified"}]}],
        scrollwheel: false, //we disable de scroll over the map, it is a really annoing when you scroll through page
     };
      var map = new google.maps.Map(document.getElementById("contactUs2Map"), mapOptions);

      var marker = new google.maps.Marker({
          position: myLatlng,
          title:"Hello World!"
      });
      marker.setMap(map);
  },

  presentationAnimations: function(){
      $(function() {

        var $window           = $(window),
            isTouch           = Modernizr.touch;

        if (isTouch) { $('.add-animation').addClass('animated'); }

        $window.on('scroll', revealAnimation);

        function revealAnimation() {
          // Showed...
          $(".add-animation:not(.animated)").each(function () {
            var $this     = $(this),
                offsetTop = $this.offset().top,
                scrolled = $window.scrollTop(),
                win_height_padded = $window.height();
            if (scrolled + win_height_padded > offsetTop) {
                $this.addClass('animated');
            }
          });
          // Hidden...
         $(".add-animation.animated").each(function (index) {
            var $this     = $(this),
                offsetTop = $this.offset().top;
                scrolled = $window.scrollTop(),
                windowHeight = $window.height();

                win_height_padded = windowHeight * 0.8;
            if (scrolled + win_height_padded < offsetTop) {
              $(this).removeClass('animated')
            }
          });
        }

        revealAnimation();
      });

  }
};
materialKitDemo = {       initContactUsMap: function () {           var myLatlng = google.maps.LatLng ใหม่ (44.433530, 26.093928);           var mapOptions = {             ซูม: 14             ศูนย์: myLatlng,             รูปแบบ:   [{ "featureType": "น้ำ", "จัดแต่งทรง": [{ "อิ่มตัว": 43}, { "ความสว่าง": - 11}, { "สี": "# 0088ff"}]}, { "featureType": "ถนน", "elementType": "geometry.fill", "จัดแต่งทรง": [{ "สี": "# FF0000"}, { "อิ่มตัว": - 100}, { "ความสว่าง": 99}]}, { "featureType": "ถนน", "elementType": "geometry.stroke", "จัดแต่งทรง": [{ "สี": "# 808080"}, { "ความสว่าง": 54}]}, { "featureType":" landscape.man_made " "elementType": "geometry.fill", "จัดแต่งทรง": [{ "สี": "# ece2d9"}]}, { "featureType": "poi.park", "elementType":" รูปทรงเรขาคณิต .fill " "จัดแต่งทรง": [{ "สี": "# ccdca1"}]}, { "featureType": "ถนน", "elementType": "labels.text.fill", "จัดแต่งทรง": [{" สี ":" # 767676 "}]}, {" featureType ":" ถนน", "elementType": "labels.text.stroke", "จัดแต่งทรง": [{ "สี": "# ffffff"}]} { "featureType": "ปอย", "จัดแต่งทรง": [{ "มองเห็น": "ปิด"}]}, { "featureType": "landscape.natural", "elementType": "geometry.fill", "จัดแต่งทรง" : [{ "มองเห็น": "ใน"}, { "สี": "# b8cb93"}]}, { "featureType": "poi.park", "จัดแต่งทรง": [{ "มองเห็น": "ใน"} ]}, { "featureType": "poi.sports_complex", "จัดแต่งทรง": [{ "มองเห็น": "ใน"}]}, { "featureType": "ปอ i.medical", "จัดแต่งทรง": [{ "มองเห็น": "ใน"}]}, { "featureType": "poi.business", "จัดแต่งทรง": [{ "มองเห็น": "เรียบง่าย"}]}] ,             scrollwheel: false, // เราปิดการใช้งานการเลื่อนบนแผนที่มันเป็นคำอธิบายประกอบจริง ๆ เมื่อคุณเลื่อนดูหน้า          };           var map = new google.maps.Map (document.getElementById ("contactUsMap"), mapOptions);           var marker = new google.maps.Marker ({               ตำแหน่ง: myLatlng,               ชื่อเรื่อง: "Hello World!"           });           marker.setMap (แผนที่);       }       initContactUs2Map: function () {           var lat = 44.433530;           var ยาว = 26.093928;           var centerLong = ยาว - 0.025;           var myLatlng = google.maps.LatLng ใหม่ (lat, long);           var centerPosition = google.maps.LatLng ใหม่ (lat, centerLong);           var mapOptions = {             ซูม: 14             ศูนย์: ศูนย์ตำแหน่ง,             รูปแบบ:   [{ "featureType": "น้ำ", "จัดแต่งทรง": [{ "อิ่มตัว": 43}, { "ความสว่าง": - 11}, { "สี": "# 0088ff"}]}, { "featureType": "ถนน", "elementType": "geometry.fill", "จัดแต่งทรง": [{ "สี": "# FF0000"}, { "อิ่มตัว": - 100}, { "ความสว่าง": 99}]}, { "featureType": "ถนน", "elementType": "geometry.stroke", "จัดแต่งทรง": [{ "สี": "# 808080"}, { "ความสว่าง": 54}]}, { "featureType":" landscape.man_made " "elementType": "geometry.fill", "จัดแต่งทรง": [{ "สี": "# ece2d9"}]}, { "featureType": "poi.park", "elementType":" รูปทรงเรขาคณิต .fill " "จัดแต่งทรง": [{ "สี": "# ccdca1"}]}, { "featureType": "ถนน", "elementType": "labels.text.fill", "จัดแต่งทรง": [{" สี ":" # 767676 "}]}, {" featureType ":" ถนน", "elementType": "labels.text.stroke", "จัดแต่งทรง": [{ "สี": "# ffffff"}]} { "featureType": "ปอย", "จัดแต่งทรง": [{ "มองเห็น": "ปิด"}]}, { "featureType": "landscape.natural", "elementType": "geometry.fill", "จัดแต่งทรง" : [{ "มองเห็น": "ใน"}, { "สี": "# b8cb93"}]}, { "featureType": "poi.park", "จัดแต่งทรง": [{ "มองเห็น": "ใน"} ]}, { "featureType": "poi.sports_complex", "จัดแต่งทรง": [{ "มองเห็น": "ใน"}]}, { "featureType": "ปอ i.medical", "จัดแต่งทรง": [{ "มองเห็น": "ใน"}]}, { "featureType": "poi.business", "จัดแต่งทรง": [{ "มองเห็น": "เรียบง่าย"}]}] ,             scrollwheel: false, // เราปิดการใช้งานการเลื่อนบนแผนที่มันเป็นคำอธิบายประกอบจริง ๆ เมื่อคุณเลื่อนดูหน้า          };           var map = new google.maps.Map (document.getElementById ("contactUs2Map"), mapOptions);           var marker = new google.maps.Marker ({               ตำแหน่ง: myLatlng,               ชื่อเรื่อง: "Hello World!"           });           marker.setMap (แผนที่);       }       presentationAnimations: function () {           $ (ฟังก์ชั่น () {             var $ window = $ (หน้าต่าง)                 isTouch = Modernizr.touch;             if (isTouch) {$ ('. add-animation'). addClass ('animated'); }             $ window.on ('เลื่อน', reveAnimation);             ฟังก์ชั่น unveAnimation () {               // แสดงแล้ว ...               $ (". add-animation: ไม่ (.animated)"). แต่ละ (function () {                 var $ this = $ (นี่)                     offsetTop = $ this.offset (). top,                     scrolled = $ window.scrollTop (),                     win_height_padded = $ window.height ();                 if (เลื่อน + win_height_padded> offsetTop) {                     $ this.addClass ( 'เคลื่อนไหว');                 }               });               // ซ่อน ...              $ (". add-animation.animated"). แต่ละอัน (ฟังก์ชั่น (ดัชนี) {                 var $ this = $ (นี่)                     offsetTop = $ this.offset (). top;                     scrolled = $ window.scrollTop (),                     windowHeight = $ window.height ();                     win_height_padded = windowHeight * 0.8;                 if (เลื่อน + win_height_padded <offsetTop) {                   $ (นี้) .removeClass (ภาพเคลื่อนไหว)                 }               });             }             revealAnimation ();           });       } };
translated from: English