
function docready() {
    $(".logo, .nav a, .track-desc a, a.track-desc, .pagi-nav a, .side-item, .speedbar a").addClass('wajax');
	// активируем нужные ссылки для переходов по страницам без перезагрузки. перечисление через запятую. 
	
	$('.ftext').each(function(){
		var h = $(this).outerHeight();
		if (h > 200) {
			$(this).css({'overflow':'hidden','height':'200px'});
			$(this).after('<div class="show-text anim fx-col fx-center"><span class="fal fa-arrow-down"></span></div>');
		};
	});	
	$('body').on('click','.show-text',function(){$('.ftext').removeAttr('style'); $(this).remove();});
	
    $('#dle-content > #dle-ajax-comments').appendTo($('#full-comms')); 
	 
};

$(document).ready(function(){

	docready();
	
	$(document).pjax(".wajax", "#wajax", {
		"fragment":"#wajax",
		"push":true,
		"replace":false,
		"timeout":30000,
		"scrollTo":0
	});
	$(document).on('pjax:send', function() {
		ShowLoading('');
		$('.login-box, .overlay-box').fadeOut(200);
		$('#side-panel, .btn-close').removeClass('active');
		$('body').removeClass('opened-menu');
	});
	$(document).on('pjax:success', function() {
		docready();
		HideLoading('');
	});
	$(document).on('pjax:error', function() {
		HideLoading('');
	  	alert('Что-то пошло не так');
	});

	apInit();
	
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

function apBuilding(e){null==(n=localStorage.getItem("vol"))&&localStorage.setItem("vol",1),$(".js-item").removeClass("js-item-played js-item-stopped js-item-current"),$(".wplayer, .track-equalizer").remove();var a=e.data(),t=a.track,i=a.artist,s=a.title,a=a.img,n=localStorage.getItem("vol");e.addClass("js-item-current js-item-stopped"),$("body").append('<div class="wplayer wplayer-init anim"><audio preload="none" controls><source src="'+t+'" /></audio></div>');e=$(".wplayer");e.find("audio").audioPlayer(),e.find("audio").get(0).volume=n;e=e.children(".audioplayer");e.addClass("fx-row fx-middle").prepend('<div class="ap-mob-btn hidden"><span class="fal fa-info-circle"></span></div><div class="ap-desc fx-row fx-middle fx-1"><div class="ap-img img-fit"><img src="'+a+'"></div><div class="ap-info fx-1"><div class="ap-title nowrap">'+s+'</div><div class="ap-artist nowrap">'+i+"</div></div></div>").find(".audioplayer-playpause").wrap('<div class="ap-btns fx-row fx-middle"></div>'),e.find(".audioplayer-volume").before('<a href="'+t+'" class="ap-dl" download target=_blank"><span class="fal fa-arrow-circle-down"></span></a>'),e.find(".audioplayer-time-duration").wrap('<div class="ap-time fx-row"></div>'),e.find(".audioplayer-time-current").prependTo(".ap-time"),e.find(".ap-btns").append('<div class="ap-next fx-col fx-center"><span class="fas fa-forward"></span></div><div class="ap-prev fx-col fx-center fx-first"><span class="fas fa-backward"></span></div>')}function apInit(){var e=$(".js-item:first");0<e.length&&apBuilding(e)}function apPrev(){var e=$(".js-item-current").index(".js-item");apBuilding($(".js-item").eq(e-1).length?$(".js-item").eq(e-1):$(".js-item:last")),$(".audioplayer-playpause a").trigger("click")}function apNext(){var e=$(".js-item-current").index(".js-item");apBuilding($(".js-item").eq(e+1).length?$(".js-item").eq(e+1):$(".js-item:first")),$(".audioplayer-playpause a").trigger("click")}!function(b,e,t){function C(e){var a=e/3600,t=Math.floor(a),i=e%3600/60,s=Math.floor(i);return 59<(e=Math.ceil(e%3600%60))&&(e=0,s=Math.ceil(i)),59<s&&(s=0,t=Math.ceil(a)),(0==t?"":0<t&&t.toString().length<2?"0"+t+":":t+":")+(s.toString().length<2?"0"+s:s)+":"+(e.toString().length<2?"0"+e:e)}function w(e){var a=t.createElement("audio");return!(!a.canPlayType||!a.canPlayType("audio/"+e.split(".").pop().toLowerCase()+";").replace(/no/,""))}var j="ontouchstart"in e,P=j?"touchstart":"mousedown",x=j?"touchmove":"mousemove",$=j?"touchcancel":"mouseup";b.fn.audioPlayer=function(g){var e,g=b.extend({classPrefix:"audioplayer",strPlay:"Играть",strPause:"Пауза",strVolume:"Громкость",strPlayI:'<span class="fas fa-play"></span>',strPauseI:'<span class="fas fa-pause"></span>',strVolumeI:'<span class="fas fa-volume-up"></span>'},g),y={},a={playPause:"playpause",playing:"playing",stopped:"stopped",time:"time",timeCurrent:"time-current",timeDuration:"time-duration",bar:"bar",barLoaded:"bar-loaded",barPlayed:"bar-played",volume:"volume",volumeButton:"volume-button",volumeAdjust:"volume-adjust",noVolume:"novolume",muted:"muted",mini:"mini"};for(e in a)y[e]=g.classPrefix+"-"+a[e];return this.each(function(){if("audio"!=b(this).prop("tagName").toLowerCase())return!1;var e=b(this),a=e.attr("src"),t=""===(t=e.get(0).getAttribute("autoplay"))||"autoplay"===t,i=""===(i=e.get(0).getAttribute("loop"))||"loop"===i,s=!0;void 0===a?e.find("source").each(function(){if(void 0!==(a=b(this).attr("src"))&&w(a))return!(s=!0)}):w(a)&&(s=!0);var n,l,d,o,r,u,p,m,c,v,f=b('<div class="'+g.classPrefix+'">'+(s?b("<div>").append(e.eq(0).clone()).html():'<embed src="'+a+'" width="0" height="0" volume="100" autostart="'+t.toString()+'" loop="'+i.toString()+'" />')+'<div class="'+y.playPause+'" title="'+g.strPlay+'"><a href="#">'+g.strPauseI+"</a></div></div>"),h=(h=s?f.find("audio"):f.find("embed")).get(0);s?(f.find("audio").css({width:0,height:0,visibility:"hidden"}),f.append('<div class="'+y.time+" "+y.timeCurrent+'"></div><div class="'+y.bar+'"><div class="'+y.barLoaded+'"></div><div class="'+y.barPlayed+'"></div></div><div class="'+y.time+" "+y.timeDuration+'"></div><div class="'+y.volume+'"><div class="'+y.volumeButton+'" title="'+g.strVolume+'"><a href="#">'+g.strVolumeI+'</a></div><div class="'+y.volumeAdjust+'"><div><div></div></div></div></div>'),n=f.find("."+y.bar),l=f.find("."+y.barPlayed),d=f.find("."+y.barLoaded),o=f.find("."+y.timeCurrent),r=f.find("."+y.timeDuration),u=f.find("."+y.volumeButton),p=f.find("."+y.volumeAdjust+" > div"),m=0,c=function(e){theRealEvent=j?e.originalEvent.touches[0]:e,h.currentTime=Math.round(h.duration*(theRealEvent.pageX-n.offset().left)/n.width())},v=function(e){theRealEvent=j?e.originalEvent.touches[0]:e,h.volume=Math.abs((theRealEvent.pageY-(p.offset().top+p.height()))/p.height())},i=h.volume,h.volume=.111,Math.round(1e3*h.volume)/1e3==.111?h.volume=i:f.addClass(y.noVolume),r.html("&hellip;"),o.html(C(0)),h.addEventListener("loadeddata",function(){var e;e=setInterval(function(){return h.buffered.length<1||(d.width(h.buffered.end(0)/h.duration*100+"%"),void(Math.floor(h.buffered.end(0))>=Math.floor(h.duration)&&clearInterval(e)))},100),r.html(b.isNumeric(h.duration)?C(h.duration):"&hellip;"),p.find("div").height(100*h.volume+"%"),m=h.volume}),h.addEventListener("timeupdate",function(){o.html(C(h.currentTime)),l.width(h.currentTime/h.duration*100+"%")}),h.addEventListener("volumechange",function(){p.find("div").height(100*h.volume+"%"),0<h.volume&&f.hasClass(y.muted)&&f.removeClass(y.muted),h.volume<=0&&!f.hasClass(y.muted)&&f.addClass(y.muted),localStorage.setItem("vol",h.volume)}),h.addEventListener("ended",function(){f.removeClass(y.playing).addClass(y.stopped),apNext()}),n.on(P,function(e){c(e),n.on(x,function(e){c(e)})}).on($,function(){n.unbind(x)}),u.on("click",function(){return f.hasClass(y.muted)?(f.removeClass(y.muted),h.volume=m):(f.addClass(y.muted),m=h.volume,h.volume=0),!1}),p.on(P,function(e){v(e),p.on(x,function(e){v(e)})}).on($,function(){p.unbind(x)})):f.addClass(y.mini),f.addClass(t?y.playing:y.stopped),f.find("."+y.playPause).on("click",function(){b(this).parent().parent().attr("class");return f.hasClass(y.playing)?(b(this).attr("title",g.strPlay).find("a").html(g.strPlayI),f.removeClass(y.playing).addClass(y.stopped),s?h.pause():h.Stop(),b(".js-item-current").removeClass("js-item-played").addClass("js-item-stopped")):(b(this).attr("title",g.strPause).find("a").html(g.strPauseI),f.addClass(y.playing).removeClass(y.stopped),s?h.play():h.Play(),b(".js-item-current").removeClass("js-item-stopped").addClass("js-item-played"),b(".wplayer").removeClass("wplayer-init")),!1}),e.replaceWith(f)}),this}}(jQuery,window,document);

/*!
 * Copyright 2012, Chris Wanstrath
 * Released under the MIT License
 * https://github.com/defunkt/jquery-pjax
 */
!function(v){function t(t,e,n){return n=u(e,n),this.on("click.pjax",t,function(t){var e=n;e.container||((e=v.extend({},n)).container=v(this).attr("data-pjax")),a(t,e)})}function a(t,e,n){n=u(e,n);var a=t.currentTarget,r=v(a);if("A"!==a.tagName.toUpperCase())throw"$.fn.pjax or $.pjax.click requires an anchor element";if(!(1<t.which||t.metaKey||t.ctrlKey||t.shiftKey||t.altKey||location.protocol!==a.protocol||location.hostname!==a.hostname||-1<a.href.indexOf("#")&&c(a)==c(location)||t.isDefaultPrevented())){var i={url:a.href,container:r.attr("data-pjax"),target:a},o=v.extend({},i,n),s=v.Event("pjax:click");r.trigger(s,[o]),s.isDefaultPrevented()||(x(o),t.preventDefault(),r.trigger("pjax:clicked",[o]))}}function e(t,e,n){n=u(e,n);var a=t.currentTarget,r=v(a);if("FORM"!==a.tagName.toUpperCase())throw"$.pjax.submit requires a form element";var i={type:(r.attr("method")||"GET").toUpperCase(),url:r.attr("action"),container:r.attr("data-pjax"),target:a};if("GET"!==i.type&&void 0!==window.FormData)i.data=new FormData(a),i.processData=!1,i.contentType=!1;else{if(r.find(":file").length)return;i.data=r.serializeArray()}x(v.extend({},i,n)),t.preventDefault()}function x(d){d=v.extend(!0,{},v.ajaxSettings,x.defaults,d),v.isFunction(d.url)&&(d.url=d.url());var f=b(d.url).hash,t=v.type(d.container);if("string"!==t)throw"expected string value for 'container' option; got "+t;var a,h=d.context=v(d.container);if(!h.length)throw"the container selector '"+d.container+"' did not match anything";function m(t,e,n){(n=n||{}).relatedTarget=d.target;var a=v.Event(t,n);return h.trigger(a,e),!a.isDefaultPrevented()}d.data||(d.data={}),v.isArray(d.data)?d.data.push({name:"_pjax",value:d.container}):d.data._pjax=d.container,d.beforeSend=function(t,e){if("GET"!==e.type&&(e.timeout=0),t.setRequestHeader("X-PJAX","true"),t.setRequestHeader("X-PJAX-Container",d.container),!m("pjax:beforeSend",[t,e]))return!1;0<e.timeout&&(a=setTimeout(function(){m("pjax:timeout",[t,d])&&t.abort("timeout")},e.timeout),e.timeout=0);var n=b(e.url);f&&(n.hash=f),d.requestUrl=l(n)},d.complete=function(t,e){a&&clearTimeout(a),m("pjax:complete",[t,e,d]),m("pjax:end",[t,d])},d.error=function(t,e,n){var a=T("",t,d),r=m("pjax:error",[t,e,n,d]);"GET"==d.type&&"abort"!==e&&r&&g(a.url)},d.success=function(t,e,n){var a=x.state,r="function"==typeof v.pjax.defaults.version?v.pjax.defaults.version():v.pjax.defaults.version,i=n.getResponseHeader("X-PJAX-Version"),o=T(t,n,d),s=b(o.url);if(f&&(s.hash=f,o.url=s.href),r&&i&&r!==i)g(o.url);else if(o.contents){if(x.state={id:d.id||j(),url:o.url,title:o.title,container:d.container,fragment:d.fragment,timeout:d.timeout},(d.push||d.replace)&&window.history.replaceState(x.state,o.title,o.url),v.contains(h,document.activeElement))try{document.activeElement.blur()}catch(t){}o.title&&(document.title=o.title),m("pjax:beforeReplace",[o.contents,d],{state:x.state,previousState:a}),h.html(o.contents);var c=h.find("input[autofocus], textarea[autofocus]").last()[0];c&&document.activeElement!==c&&c.focus(),function(t){if(!t)return;var a=v("script[src]");t.each(function(){var t=this.src;if(!a.filter(function(){return this.src===t}).length){var e=document.createElement("script"),n=v(this).attr("type");n&&(e.type=n),e.src=v(this).attr("src"),document.head.appendChild(e)}})}(o.scripts);var u=d.scrollTo;if(f){var l=decodeURIComponent(f.slice(1)),p=document.getElementById(l)||document.getElementsByName(l)[0];p&&(u=v(p).offset().top)}"number"==typeof u&&v(window).scrollTop(u),m("pjax:success",[t,e,n,d])}else g(o.url)},x.state||(x.state={id:j(),url:window.location.href,title:document.title,container:d.container,fragment:d.fragment,timeout:d.timeout},window.history.replaceState(x.state,document.title)),y(x.xhr),x.options=d;var e,n,r=x.xhr=v.ajax(d);return 0<r.readyState&&(d.push&&!d.replace&&(e=x.state.id,n=[d.container,w(h)],E[e]=n,P.push(e),C(S,0),C(P,x.defaults.maxCacheLength),window.history.pushState(null,"",d.requestUrl)),m("pjax:start",[r,d]),m("pjax:send",[r,d])),x.xhr}function n(t,e){var n={url:window.location.href,push:!1,replace:!0,scrollTo:!1};return x(v.extend(n,u(t,e)))}function g(t){window.history.replaceState(null,"",x.state.url),window.location.replace(t)}var p=!0,d=window.location.href,r=window.history.state;function i(t){p||y(x.xhr);var e,n=x.state,a=t.state;if(a&&a.container){if(p&&d==a.url)return;if(n){if(n.id===a.id)return;e=n.id<a.id?"forward":"back"}var r=E[a.id]||[],i=r[0]||a.container,o=v(i),s=r[1];if(o.length){n&&function(t,e,n){var a,r;E[e]=n,r="forward"===t?(a=P,S):(a=S,P);a.push(e),(e=r.pop())&&delete E[e];C(a,x.defaults.maxCacheLength)}(e,n.id,[i,w(o)]);var c=v.Event("pjax:popstate",{state:a,direction:e});o.trigger(c);var u={id:a.id,url:a.url,container:i,push:!1,fragment:a.fragment,timeout:a.timeout,scrollTo:!1};if(s){o.trigger("pjax:start",[null,u]),(x.state=a).title&&(document.title=a.title);var l=v.Event("pjax:beforeReplace",{state:a,previousState:n});o.trigger(l,[s,u]),o.html(s),o.trigger("pjax:end",[null,u])}else x(u);o[0].offsetHeight}else g(location.href)}p=!1}function o(t){var e=v.isFunction(t.url)?t.url():t.url,n=t.type?t.type.toUpperCase():"GET",a=v("<form>",{method:"GET"===n?"GET":"POST",action:e,style:"display:none"});"GET"!==n&&"POST"!==n&&a.append(v("<input>",{type:"hidden",name:"_method",value:n.toLowerCase()}));var r=t.data;if("string"==typeof r)v.each(r.split("&"),function(t,e){var n=e.split("=");a.append(v("<input>",{type:"hidden",name:n[0],value:n[1]}))});else if(v.isArray(r))v.each(r,function(t,e){a.append(v("<input>",{type:"hidden",name:e.name,value:e.value}))});else if("object"==typeof r){var i;for(i in r)a.append(v("<input>",{type:"hidden",name:i,value:r[i]}))}v(document.body).append(a),a.submit()}function y(t){t&&t.readyState<4&&(t.onreadystatechange=v.noop,t.abort())}function j(){return(new Date).getTime()}function w(t){var e=t.clone();return e.find("script").each(function(){this.src||v._data(this,"globalEval",!1)}),e.contents()}function l(t){return t.search=t.search.replace(/([?&])(_pjax|_)=[^&]*/g,"").replace(/^&/,""),t.href.replace(/\?($|#)/,"$1")}function b(t){var e=document.createElement("a");return e.href=t,e}function c(t){return t.href.replace(/#.*/,"")}function u(t,e){return t&&e?((e=v.extend({},e)).container=t,e):v.isPlainObject(t)?t:{container:t}}function f(t,e){return t.filter(e).add(t.find(e))}function h(t){return v.parseHTML(t,document,!0)}function T(t,e,n){var a,r,i={},o=/<html/i.test(t),s=e.getResponseHeader("X-PJAX-URL");if(i.url=s?l(b(s)):n.requestUrl,o){r=v(h(t.match(/<body[^>]*>([\s\S.]*)<\/body>/i)[0]));var c=t.match(/<head[^>]*>([\s\S.]*)<\/head>/i);a=null!=c?v(h(c[0])):r}else a=r=v(h(t));if(0===r.length)return i;if(i.title=f(a,"title").last().text(),n.fragment){var u=r;"body"!==n.fragment&&(u=f(u,n.fragment).first()),u.length&&(i.contents="body"===n.fragment?u:u.contents(),i.title||(i.title=u.attr("title")||u.data("title")))}else o||(i.contents=r);return i.contents&&(i.contents=i.contents.not(function(){return v(this).is("title")}),i.contents.find("title").remove(),i.scripts=f(i.contents,"script[src]").remove(),i.contents=i.contents.not(i.scripts)),i.title&&(i.title=v.trim(i.title)),i}r&&r.container&&(x.state=r),"state"in window.history&&(p=!1);var E={},S=[],P=[];function C(t,e){for(;t.length>e;)delete E[t.shift()]}function s(){return v("meta").filter(function(){var t=v(this).attr("http-equiv");return t&&"X-PJAX-VERSION"===t.toUpperCase()}).attr("content")}function m(){v.fn.pjax=t,v.pjax=x,v.pjax.enable=v.noop,v.pjax.disable=A,v.pjax.click=a,v.pjax.submit=e,v.pjax.reload=n,v.pjax.defaults={timeout:650,push:!0,replace:!1,type:"GET",dataType:"html",scrollTo:0,maxCacheLength:20,version:s},v(window).on("popstate.pjax",i)}function A(){v.fn.pjax=function(){return this},v.pjax=o,v.pjax.enable=m,v.pjax.disable=v.noop,v.pjax.click=v.noop,v.pjax.submit=v.noop,v.pjax.reload=function(){window.location.reload()},v(window).off("popstate.pjax",i)}v.event.props&&v.inArray("state",v.event.props)<0?v.event.props.push("state"):"state"in v.Event.prototype||v.event.addProp("state"),v.support.pjax=window.history&&window.history.pushState&&window.history.replaceState&&!navigator.userAgent.match(/((iPod|iPhone|iPad).+\bOS\s+[1-4]\D|WebApps\/.+CFNetwork)/),(v.support.pjax?m:A)()}(jQuery);


/* end */