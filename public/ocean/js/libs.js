
$(document).ready(function(){

	// apInit();
	
	$('body').on('click', '.js-play', function() {
		var currentPlayBtn = $(this), currentPlay = currentPlayBtn.closest('.js-item');
		if ( currentPlay.hasClass('js-item-current') ) {
			$('.audioplayer-playpause a').trigger( "click" );
		} else {
			apBuilding(currentPlay);
			$('.audioplayer-playpause a').trigger( "click" );
		};
	});
	
	$('body').on('click', '.ap-next', function() {
		apNext();
	});
	$('body').on('click', '.ap-prev', function() {
		apPrev();
	});
	$('body').on('click', '.ap-mob-btn', function() {
		$('.ap-desc').toggleClass('is-active');
		$(this).find('.fal').toggleClass('fa-info-circle fa-times');
	});

	
	$('body').on('click','.overlay-box, .login-close, .search-close, .btn-close',function(){
		$('.overlay-box, .login-box').fadeOut(200);
		$('#side-panel, .btn-close').removeClass('active');
		$('body').removeClass('opened-menu');
	});
	
	$('body').append('<div class="overlay-box hidden"></div><div class="side-panel" id="side-panel"></div><div class="btn-close"><span class="fal fa-times"></span></div>');
	$('.to-mob').each(function() {
		$(this).clone().appendTo('#side-panel');
	});		
	$(".btn-menu").click(function(){
		$('.overlay-box').fadeIn(200);;
		$('#side-panel, .btn-close').addClass('active');
		$('body').addClass('opened-menu');
	});

	$('#gotop').click(function(){
		$('html, body').animate({ scrollTop : 0 }, 'slow');
  	});

	  $('body').on('click','#nav-load a',function(){
		  var urlNext = $(this).attr('href'), scrollNext = $(this).offset().top - 200;
		  if (urlNext !== undefined) {
			  $.ajax({
				  url: urlNext,
				  beforeSend: function() { ShowLoading(''); },			 
				  success: function(data) {
					  $('#bottom-nav').remove();
					  $('#dle-content').append($('#dle-content', data).html());
					  $('#dle-content').after($('#bottom-nav'));
					  $('.track-desc a, a.track-desc').addClass('wajax');
					  //window.history.pushState("", "", urlNext);
					  $('html, body').animate({scrollTop:scrollNext}, 800);	
					  HideLoading('');
				  },
					error: function() {	HideLoading(''); alert('что-то пошло не так'); }
			  });
		  };
		  return false;
	  });
  
	$('body').on('click', '.hshare > *', function() {
		var id = $(this).data('id');
		social_share(id);
	});
});

function social_share(id) {
    var like_title = encodeURIComponent(document.title),
        like_url = encodeURIComponent(window.location.href),
        like_image = encodeURIComponent($('meta[property="og:image"]').attr('content'));
    if (like_image == undefined) {
        like_image = '';
    }
    if (id == 'vk') {
        var url = "https://vk.com/share.php?title=" + like_title + "&description=" + "&url=" + like_url + "&image=" + like_image + "&nocache-";
    } else if (id == 'fb') {
        var url = "https://www.facebook.com/sharer.php?s=100&p[title]=" + like_title + "&p[url]=" + like_url + "&p[images][0]=" + like_image + "&nocache-";
    } else if (id == 'tw') {
        var url = "https://twitter.com/share?text=" + like_title + "&url=" + like_url + "&counturl=" + like_url + "&nocache-";
    } else if (id == 'ggl') {
        var url = "https://plus.google.com/share?url=" + like_url + "&title=" + like_title + "&imageurl=" + like_image;
    } else if (id == 'ok') {
        var url = "https://connect.ok.ru/offer?url=" + like_url;
    } else if (id == 'tlg') {
        var url = "https://telegram.me/share/url?url=" + like_url + "&text=" + like_title;
    }
    window.open(url, '', 'toolbar=0,status=0,width=655,height=430');
};

function apBuilding(e){null==(n=localStorage.getItem("vol"))&&localStorage.setItem("vol",1),$(".js-item").removeClass("js-item-played js-item-stopped js-item-current"),$(".wplayerwplayer, .track-equalizer").remove();var a=e.data(),t=a.track,i=a.artist,s=a.title,a=a.img,n=localStorage.getItem("vol");e.addClass("js-item-current js-item-stopped"),$("body").append('<div class="wplayer wplayer-init anim"><audio preload="none" controls><source src="'+t+'" /></audio></div>');e=$(".wplayer");e.find("audio").audioPlayer(),e.find("audio").get(0).volume=n;e=e.children(".audioplayer");e.addClass("fx-row fx-middle").prepend('<div class="ap-mob-btn hidden"><span class="fal fa-info-circle"></span></div><div class="ap-desc fx-row fx-middle fx-1"><div class="ap-img img-fit"><img src="'+a+'"></div><div class="ap-info fx-1"><div class="ap-title nowrap">'+s+'</div><div class="ap-artist nowrap">'+i+"</div></div></div>").find(".audioplayer-playpause").wrap('<div class="ap-btns fx-row fx-middle"></div>'),e.find(".audioplayer-volume").before('<a href="'+t+'" class="ap-dl" download target=_blank"><span class="fal fa-arrow-circle-down"></span></a>'),e.find(".audioplayer-time-duration").wrap('<div class="ap-time fx-row"></div>'),e.find(".audioplayer-time-current").prependTo(".ap-time"),e.find(".ap-btns").append('<div class="ap-next fx-col fx-center"><span class="fas fa-forward"></span></div><div class="ap-prev fx-col fx-center fx-first"><span class="fas fa-backward"></span></div>')}function apInit(){var e=$(".js-item:first");0<e.length&&apBuilding(e)}function apPrev(){var e=$(".js-item-current").index(".js-item");apBuilding($(".js-item").eq(e-1).length?$(".js-item").eq(e-1):$(".js-item:last")),$(".audioplayer-playpause a").trigger("click")}function apNext(){var e=$(".js-item-current").index(".js-item");apBuilding($(".js-item").eq(e+1).length?$(".js-item").eq(e+1):$(".js-item:first")),$(".audioplayer-playpause a").trigger("click")}!function(b,e,t){function C(e){var a=e/3600,t=Math.floor(a),i=e%3600/60,s=Math.floor(i);return 59<(e=Math.ceil(e%3600%60))&&(e=0,s=Math.ceil(i)),59<s&&(s=0,t=Math.ceil(a)),(0==t?"":0<t&&t.toString().length<2?"0"+t+":":t+":")+(s.toString().length<2?"0"+s:s)+":"+(e.toString().length<2?"0"+e:e)}function w(e){var a=t.createElement("audio");return!(!a.canPlayType||!a.canPlayType("audio/"+e.split(".").pop().toLowerCase()+";").replace(/no/,""))}var j="ontouchstart"in e,P=j?"touchstart":"mousedown",x=j?"touchmove":"mousemove",$=j?"touchcancel":"mouseup";b.fn.audioPlayer=function(g){var e,g=b.extend({classPrefix:"audioplayer",strPlay:"Играть",strPause:"Пауза",strVolume:"Громкость",strPlayI:'<span class="fas fa-play"></span>',strPauseI:'<span class="fas fa-pause"></span>',strVolumeI:'<span class="fas fa-volume-up"></span>'},g),y={},a={playPause:"playpause",playing:"playing",stopped:"stopped",time:"time",timeCurrent:"time-current",timeDuration:"time-duration",bar:"bar",barLoaded:"bar-loaded",barPlayed:"bar-played",volume:"volume",volumeButton:"volume-button",volumeAdjust:"volume-adjust",noVolume:"novolume",muted:"muted",mini:"mini"};for(e in a)y[e]=g.classPrefix+"-"+a[e];return this.each(function(){if("audio"!=b(this).prop("tagName").toLowerCase())return!1;var e=b(this),a=e.attr("src"),t=""===(t=e.get(0).getAttribute("autoplay"))||"autoplay"===t,i=""===(i=e.get(0).getAttribute("loop"))||"loop"===i,s=!0;void 0===a?e.find("source").each(function(){if(void 0!==(a=b(this).attr("src"))&&w(a))return!(s=!0)}):w(a)&&(s=!0);var n,l,d,o,r,u,p,m,c,v,f=b('<div class="'+g.classPrefix+'">'+(s?b("<div>").append(e.eq(0).clone()).html():'<embed src="'+a+'" width="0" height="0" volume="100" autostart="'+t.toString()+'" loop="'+i.toString()+'" />')+'<div class="'+y.playPause+'" title="'+g.strPlay+'"><a href="#">'+g.strPauseI+"</a></div></div>"),h=(h=s?f.find("audio"):f.find("embed")).get(0);s?(f.find("audio").css({width:0,height:0,visibility:"hidden"}),f.append('<div class="'+y.time+" "+y.timeCurrent+'"></div><div class="'+y.bar+'"><div class="'+y.barLoaded+'"></div><div class="'+y.barPlayed+'"></div></div><div class="'+y.time+" "+y.timeDuration+'"></div><div class="'+y.volume+'"><div class="'+y.volumeButton+'" title="'+g.strVolume+'"><a href="#">'+g.strVolumeI+'</a></div><div class="'+y.volumeAdjust+'"><div><div></div></div></div></div>'),n=f.find("."+y.bar),l=f.find("."+y.barPlayed),d=f.find("."+y.barLoaded),o=f.find("."+y.timeCurrent),r=f.find("."+y.timeDuration),u=f.find("."+y.volumeButton),p=f.find("."+y.volumeAdjust+" > div"),m=0,c=function(e){theRealEvent=j?e.originalEvent.touches[0]:e,h.currentTime=Math.round(h.duration*(theRealEvent.pageX-n.offset().left)/n.width())},v=function(e){theRealEvent=j?e.originalEvent.touches[0]:e,h.volume=Math.abs((theRealEvent.pageY-(p.offset().top+p.height()))/p.height())},i=h.volume,h.volume=.111,Math.round(1e3*h.volume)/1e3==.111?h.volume=i:f.addClass(y.noVolume),r.html("&hellip;"),o.html(C(0)),h.addEventListener("loadeddata",function(){var e;e=setInterval(function(){return h.buffered.length<1||(d.width(h.buffered.end(0)/h.duration*100+"%"),void(Math.floor(h.buffered.end(0))>=Math.floor(h.duration)&&clearInterval(e)))},100),r.html(b.isNumeric(h.duration)?C(h.duration):"&hellip;"),p.find("div").height(100*h.volume+"%"),m=h.volume}),h.addEventListener("timeupdate",function(){o.html(C(h.currentTime)),l.width(h.currentTime/h.duration*100+"%")}),h.addEventListener("volumechange",function(){p.find("div").height(100*h.volume+"%"),0<h.volume&&f.hasClass(y.muted)&&f.removeClass(y.muted),h.volume<=0&&!f.hasClass(y.muted)&&f.addClass(y.muted),localStorage.setItem("vol",h.volume)}),h.addEventListener("ended",function(){f.removeClass(y.playing).addClass(y.stopped),apNext()}),n.on(P,function(e){c(e),n.on(x,function(e){c(e)})}).on($,function(){n.unbind(x)}),u.on("click",function(){return f.hasClass(y.muted)?(f.removeClass(y.muted),h.volume=m):(f.addClass(y.muted),m=h.volume,h.volume=0),!1}),p.on(P,function(e){v(e),p.on(x,function(e){v(e)})}).on($,function(){p.unbind(x)})):f.addClass(y.mini),f.addClass(t?y.playing:y.stopped),f.find("."+y.playPause).on("click",function(){b(this).parent().parent().attr("class");return f.hasClass(y.playing)?(b(this).attr("title",g.strPlay).find("a").html(g.strPlayI),f.removeClass(y.playing).addClass(y.stopped),s?h.pause():h.Stop(),b(".js-item-current").removeClass("js-item-played").addClass("js-item-stopped")):(b(this).attr("title",g.strPause).find("a").html(g.strPauseI),f.addClass(y.playing).removeClass(y.stopped),s?h.play():h.Play(),b(".js-item-current").removeClass("js-item-stopped").addClass("js-item-played"),b(".wplayer").removeClass("wplayer-init")),!1}),e.replaceWith(f)}),this}}(jQuery,window,document);
