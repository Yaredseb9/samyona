/**handles:mustache,wpcom-notes-common,wpcom-notes-admin-bar**/
var Mustache=(typeof module!=="undefined"&&module.exports)||{};(function(exports){exports.name="mustache.js";exports.version="0.5.0-dev";exports.tags=["{{","}}"];exports.parse=parse;exports.compile=compile;exports.render=render;exports.clearCache=clearCache;exports.to_html=function(template,view,partials,send){var result=render(template,view,partials);if(typeof send==="function"){send(result);}else{return result;}};var _toString=Object.prototype.toString;var _isArray=Array.isArray;var _forEach=Array.prototype.forEach;var _trim=String.prototype.trim;var isArray;if(_isArray){isArray=_isArray;}else{isArray=function(obj){return _toString.call(obj)==="[object Array]";};}
var forEach;if(_forEach){forEach=function(obj,callback,scope){return _forEach.call(obj,callback,scope);};}else{forEach=function(obj,callback,scope){for(var i=0,len=obj.length;i<len;++i){callback.call(scope,obj[i],i,obj);}};}
var spaceRe=/^\s*$/;function isWhitespace(string){return spaceRe.test(string);}
var trim;if(_trim){trim=function(string){return string==null?"":_trim.call(string);};}else{var trimLeft,trimRight;if(isWhitespace("\xA0")){trimLeft=/^\s+/;trimRight=/\s+$/;}else{trimLeft=/^[\s\xA0]+/;trimRight=/[\s\xA0]+$/;}
trim=function(string){return string==null?"":String(string).replace(trimLeft,"").replace(trimRight,"");};}
var escapeMap={"&":"&amp;","<":"&lt;",">":"&gt;",'"':'&quot;',"'":'&#39;'};function escapeHTML(string){return String(string).replace(/&(?!\w+;)|[<>"']/g,function(s){return escapeMap[s]||s;});}
function debug(e,template,line,file){file=file||"<template>";var lines=template.split("\n"),start=Math.max(line-3,0),end=Math.min(lines.length,line+3),context=lines.slice(start,end);var c;for(var i=0,len=context.length;i<len;++i){c=i+start+1;context[i]=(c===line?" >> ":"    ")+context[i];}
e.template=template;e.line=line;e.file=file;e.message=[file+":"+line,context.join("\n"),"",e.message].join("\n");return e;}
function lookup(name,stack,defaultValue){if(name==="."){return stack[stack.length-1];}
var names=name.split(".");var lastIndex=names.length-1;var target=names[lastIndex];var value,context,i=stack.length,j,localStack;while(i){localStack=stack.slice(0);context=stack[--i];j=0;while(j<lastIndex){context=context[names[j++]];if(context==null){break;}
localStack.push(context);}
if(context&&typeof context==="object"&&target in context){value=context[target];break;}}
if(typeof value==="function"){value=value.call(localStack[localStack.length-1]);}
if(value==null){return defaultValue;}
return value;}
function renderSection(name,stack,callback,inverted){var buffer="";var value=lookup(name,stack);if(inverted){if(value==null||value===false||(isArray(value)&&value.length===0)){buffer+=callback();}}else if(isArray(value)){forEach(value,function(value){stack.push(value);buffer+=callback();stack.pop();});}else if(typeof value==="object"){stack.push(value);buffer+=callback();stack.pop();}else if(typeof value==="function"){var scope=stack[stack.length-1];var scopedRender=function(template){return render(template,scope);};buffer+=value.call(scope,callback(),scopedRender)||"";}else if(value){buffer+=callback();}
return buffer;}
function parse(template,options){options=options||{};var tags=options.tags||exports.tags,openTag=tags[0],closeTag=tags[tags.length-1];var code=['var buffer = "";',"\nvar line = 1;","\ntry {",'\nbuffer += "'];var spaces=[],hasTag=false,nonSpace=false;var stripSpace=function(){if(hasTag&&!nonSpace&&!options.space){while(spaces.length){code.splice(spaces.pop(),1);}}else{spaces=[];}
hasTag=false;nonSpace=false;};var sectionStack=[],updateLine,nextOpenTag,nextCloseTag;var setTags=function(source){tags=trim(source).split(/\s+/);nextOpenTag=tags[0];nextCloseTag=tags[tags.length-1];};var includePartial=function(source){code.push('";',updateLine,'\nvar partial = partials["'+trim(source)+'"];','\nif (partial) {','\n  buffer += render(partial,stack[stack.length - 1],partials);','\n}','\nbuffer += "');};var openSection=function(source,inverted){var name=trim(source);if(name===""){throw debug(new Error("Section name may not be empty"),template,line,options.file);}
sectionStack.push({name:name,inverted:inverted});code.push('";',updateLine,'\nvar name = "'+name+'";','\nvar callback = (function () {','\n  return function () {','\n    var buffer = "";','\nbuffer += "');};var openInvertedSection=function(source){openSection(source,true);};var closeSection=function(source){var name=trim(source);var openName=sectionStack.length!=0&&sectionStack[sectionStack.length-1].name;if(!openName||name!=openName){throw debug(new Error('Section named "'+name+'" was never opened'),template,line,options.file);}
var section=sectionStack.pop();code.push('";','\n    return buffer;','\n  };','\n})();');if(section.inverted){code.push("\nbuffer += renderSection(name,stack,callback,true);");}else{code.push("\nbuffer += renderSection(name,stack,callback);");}
code.push('\nbuffer += "');};var sendPlain=function(source){code.push('";',updateLine,'\nbuffer += lookup("'+trim(source)+'",stack,"");','\nbuffer += "');};var sendEscaped=function(source){code.push('";',updateLine,'\nbuffer += escapeHTML(lookup("'+trim(source)+'",stack,""));','\nbuffer += "');};var line=1,c,callback;for(var i=0,len=template.length;i<len;++i){if(template.slice(i,i+openTag.length)===openTag){i+=openTag.length;c=template.substr(i,1);updateLine='\nline = '+line+';';nextOpenTag=openTag;nextCloseTag=closeTag;hasTag=true;switch(c){case"!":i++;callback=null;break;case"=":i++;closeTag="="+closeTag;callback=setTags;break;case">":i++;callback=includePartial;break;case"#":i++;callback=openSection;break;case"^":i++;callback=openInvertedSection;break;case"/":i++;callback=closeSection;break;case"{":closeTag="}"+closeTag;case"&":i++;nonSpace=true;callback=sendPlain;break;default:nonSpace=true;callback=sendEscaped;}
var end=template.indexOf(closeTag,i);if(end===-1){throw debug(new Error('Tag "'+openTag+'" was not closed properly'),template,line,options.file);}
var source=template.substring(i,end);if(callback){callback(source);}
var n=0;while(~(n=source.indexOf("\n",n))){line++;n++;}
i=end+closeTag.length-1;openTag=nextOpenTag;closeTag=nextCloseTag;}else{c=template.substr(i,1);switch(c){case'"':case"\\":nonSpace=true;code.push("\\"+c);break;case"\r":break;case"\n":spaces.push(code.length);code.push("\\n");stripSpace();line++;break;default:if(isWhitespace(c)){spaces.push(code.length);}else{nonSpace=true;}
code.push(c);}}}
if(sectionStack.length!=0){throw debug(new Error('Section "'+sectionStack[sectionStack.length-1].name+'" was not closed properly'),template,line,options.file);}
stripSpace();code.push('";',"\nreturn buffer;","\n} catch (e) { throw {error: e, line: line}; }");var body=code.join("").replace(/buffer \+= "";\n/g,"");if(options.debug){if(typeof console!="undefined"&&console.log){console.log(body);}else if(typeof print==="function"){print(body);}}
return body;}
function _compile(template,options){var args="view,partials,stack,lookup,escapeHTML,renderSection,render";var body=parse(template,options);var fn=new Function(args,body);return function(view,partials){partials=partials||{};var stack=[view];try{return fn(view,partials,stack,lookup,escapeHTML,renderSection,render);}catch(e){throw debug(e.error,template,e.line,options.file);}};}
var _cache={};function clearCache(){_cache={};}
function compile(template,options){options=options||{};if(options.cache!==false){if(!_cache[template]){_cache[template]=_compile(template,options);}
return _cache[template];}
return _compile(template,options);}
function render(template,view,partials){return compile(template)(view,partials);}})(Mustache);
var wpNotesCommon;var wpNotesCommentModView;var wpNoteList;var wpNoteModel;(function($){var cookies=document.cookie.split(/;\s*/),cookie=false;for(i=0;i<cookies.length;i++){if(cookies[i].match(/^wp_api=/)){cookies=cookies[i].split('=');cookie=cookies[1];break;}}
wpNotesCommon={jsonAPIbase:'https://public-api.wordpress.com/rest/v1',hasUpgradedProxy:false,noteTypes:{comment:'comment',follow:'follow',like:['like','like_trap'],reblog:'reblog',trophy:['best_liked_day_feat','like_milestone_achievement','achieve_automattician_note','achieve_user_anniversary','best_followed_day_feat','followed_milestone_achievement'],'alert':['expired_domain_alert']},noteType2Noticon:{'like':'like','follow':'follow','comment_like':'like','comment':'comment','comment_pingback':'external','reblog':'reblog','like_milestone_achievement':'trophy','achieve_followed_milestone_note':'trophy','achieve_user_anniversary':'trophy','best_liked_day_feat':'milestone','best_followed_day_feat':'milestone','automattician_achievement':'trophy','expired_domain_alert':'alert','automattcher':'atsign'},createNoteContainer:function(note,id_prefix){var note_container=$('<div/>',{id:id_prefix+'-note-'+note.id,'class':'wpn-note wpn-'+note.type+' '+((note.unread>0)?'wpn-unread':'wpn-read')}).data({id:parseInt(note.id,10),type:note.type});var note_body=$('<div/>',{"class":"wpn-note-body wpn-note-body-empty"});var spinner=$('<div/>',{style:'position: absolute; left: 180px; top: 60px;'});note_body.append(spinner);spinner.spin('medium');note_container.append(this.createNoteSubject(note),note_body);return note_container;},createNoteSubject:function(note){var subj=$('<div/>',{"class":"wpn-note-summary"}).append($('<span/>',{"class":'wpn-noticon noticon noticon'+note.noticon}),$('<span/>',{"class":'wpn-icon no-grav',html:$('<img/>',{src:note.subject.icon,width:'24px',height:'24px',style:'display: inline-block; width: 24px; height: 24px; overflow-x: hidden; overflow-y: hidden;'})}),$('<span/>',{"class":'wpn-subject',html:note.subject.html}));return subj;},createNoteBody:function(note_model){var note_body=$('<div/>',{"class":"wpn-note-body"});var note=note_model.toJSON();var class_prefix='wpn-'+note.body.template;switch(note.body.template){case'single-line-list':case'multi-line-list':note_body.append($('<p/>').addClass(class_prefix+'-header').html(note.body.header));for(var i in note.body.items){var item=$('<div></div>',{'class':class_prefix+'-item '+class_prefix+'-item-'+i+
(note.body.items[i].icon?'':' '+class_prefix+'-item-no-icon')});if(note.body.items[i].icon){item.append($('<img/>',{"class":class_prefix+'-item-icon avatar avatar-'+note.body.items[i].icon_width,height:note.body.items[i].icon_height,width:note.body.items[i].icon_width,src:note.body.items[i].icon}));}
if(note.body.items[i].header){item.append($('<div></div>',{'class':class_prefix+'-item-header'}).html(note.body.items[i].header));}
if(note.body.items[i].action){switch(note.body.items[i].action.type){case'follow':var button=wpFollowButton.create(note.body.items[i].action);item.append(button);button.click(function(e){if($(this).children('a').hasClass('wpcom-follow-rest'))
wpNotesCommon.bumpStat('notes-click-action','unfollow');else
wpNotesCommon.bumpStat('notes-click-action','follow');return true;});break;default:console.error("Unsupported "+note.type+" action: "+note.body.items[i].action.type);break;}}
if(note.body.items[i].html){item.append($('<div></div>',{'class':class_prefix+'-item-body'}).html(note.body.items[i].html));}
note_body.append(item);}
if(note.body.actions){var note_actions=new wpNotesCommentModView({model:note_model});note_actions.render();note_body.append(note_actions.el);}
if(note.body.footer){note_body.append($('<p/>').addClass(class_prefix+'-footer').html(note.body.footer));}
break;case'big-badge':if(note.body.header){note_body.append($('<div/>').addClass(class_prefix+'-header').html(note.body.header));}
if(note.body.badge){note_body.append($('<div></div>',{'class':class_prefix+'-badge '}).append(note.body.badge));}
if(note.body.html!==''){note_body.append($('<div/>').addClass(class_prefix+'-footer').html(note.body.html));}
break;default:note_body.text('Unsupported note body template!');break;}
note_body.find('a[notes-data-click]').mousedown(function(e){var type=$(this).attr('notes-data-click');wpNotesCommon.bumpStat('notes-click-body',type);return true;});return note_body;},getNoteSubjects:function(query_params,success,fail){query_params.fields='id,type,unread,noticon,timestamp,subject';query_params.trap=true;return this.getNotes(query_params,success,fail);},getNotes:function(query_params,success,fail){return this.ajax({type:'GET',path:'/notifications/',data:query_params,success:success,error:fail});},getMentions:function(query_params,success){return this.ajax({type:'GET',path:'/users/suggest',data:query_params,success:success});},markNotesSeen:function(timestamp){return this.ajax({type:'POST',path:'/notifications/seen',data:{time:timestamp}});},markNotesRead:function(unread_cnts){var query_args={};var t=this;for(var id in unread_cnts){if(unread_cnts[id]>0){query_args['counts['+id+']']=unread_cnts[id];}}
if(0===query_args.length){return(new $.Deferred()).resolve('no unread notes');}
return this.ajax({type:'POST',path:'/notifications/read',data:query_args,success:function(res){},error:function(res){}});},ajax:function(options){var t=this;var request={path:options.path,method:options.type};if(options.type.toLowerCase()=='post')
request.body=options.data;else
request.query=options.data;return $.Deferred(function(dfd){var makeProxyCall=function(){$.wpcom_proxy_request(request,function(response,statusCode){if(200==statusCode){if('function'==typeof options.success){options.success(response);}
return dfd.resolve(response);}
if('function'==typeof options.error){options.error(statusCode);}
else{console.error(statusCode);}
return dfd.reject(statusCode);});};if(t.hasUpgradedProxy){return makeProxyCall();}
return $.wpcom_proxy_request({metaAPI:{accessAllUsersBlogs:true}}).done(function(){t.hasUpgradedProxy=true;makeProxyCall();});});},bumpStat:function(group,names){if('undefined'!=typeof wpNotesIsJetpackClient&&wpNotesIsJetpackClient){var jpStats=['notes-menu-impressions','notes-menu-clicks'];if(_.contains(jpStats,group)){names=names.replace(/(,|$)/g,'-jetpack$1');}}
new Image().src=document.location.protocol+'//pixel.wp.com/g.gif?v=wpcom-no-pv&x_'+group+'='+names+'&baba='+Math.random();},getKeycode:function(key_event){key_event=key_event||window.event;if(key_event.target)
element=key_event.target;else if(key_event.srcElement)
element=key_event.srcElement;if(element.nodeType==3)
element=element.parentNode;if(key_event.ctrlKey===true||key_event.altKey===true||key_event.metaKey===true)
return false;var keyCode=(key_event.keyCode)?key_event.keyCode:key_event.which;if(keyCode&&(element.tagName=='INPUT'||element.tagName=='TEXTAREA'||element.tagName=='SELECT'))
return false;if(keyCode&&element.contentEditable=="true")
return false;return keyCode;}};wpNoteModel=Backbone.Model.extend({defaults:{summary:"",unread:true},_reloadBlocked:false,initialize:function(){},markRead:function(){var unread_cnt=this.get('unread');if(Boolean(parseInt(unread_cnt,10))){var notes={};notes[this.id]=unread_cnt;wpNotesCommon.markNotesRead(notes);wpNotesCommon.bumpStat('notes-read-type',this.get('type'));}},loadBody:function(){wpNotesCommon.createNoteBody(this);},reload:function(){var t=this;var fields='id,type,unread,noticon,subject,body,date,timestamp,status';if('comment'==t.get('type')){fields+=',approval_status,has_replied';}
if(!force&&this.isReloadingBlocked()){return $.Deferred().reject('reloading blocked');}
return wpNotesCommon.getNotes({fields:fields,trap:true,ids:[t.get('id')]},function(res){var notes=res.notes;if(typeof notes[0]!=='undefined'){t.set(notes[0]);}},function(){});},resize:function(){this.trigger('resize');},blockReloading:function(seconds){var _this=this;this._reloadBlocked=true;clearTimeout(this.reloadBlockerTimeout);return this.reloadBlockerTimeout=setTimeout(function(){return _this._reloadBlocked=false;},seconds*1000);},isReloadingBlocked:function(){return this._reloadBlocked;}});wpNoteList=Backbone.Collection.extend({model:wpNoteModel,lastMarkedSeenTimestamp:false,newNotes:false,maxNotes:false,loading:false,hasLoaded:false,allBodiesLoaded:false,comparator:function(note){return-note.get('timestamp');},addNotes:function(notes){notes=_.filter(notes,function(note){return typeof(note.subject)==="object";});var models=_.map(notes,function(o){return new wpNoteModel(o);});this.add(models);this.sort();if(this.maxNotes){while(this.length>this.maxNotes){this.pop();}}
this.trigger('loadNotes:change');},getMostRecentTimestamp:function(){if(!this.length){return false;}
this.sort();return parseInt(this.at(0).get('timestamp'),10);},loadNotes:function(query_args){var t=this;t.loading=true;t.trigger('loadNotes:beginLoading');var fields=query_args.fields;var number=parseInt(query_args.number,10);var before=parseInt(query_args.before,10);var since=parseInt(query_args.since,10);var timeout=parseInt(query_args.timeout,10)||7000;var type='undefined'==typeof query_args.type?null:query_args.type;var unread='undefined'==typeof query_args.unread?null:query_args.unread;query_args={timeout:timeout};if(!fields){fields='id,type,unread,noticon,subject,body,date,timestamp,status';}
if(isNaN(number)){number=9;}
if(!isNaN(before)){query_args.before=before;}
if(!isNaN(since)){query_args.since=since;}
if(unread!==null){query_args.unread=unread;}
if(type!==null&&type!="unread"&&type!="latest"){query_args.type=type;}
query_args.number=number;query_args.fields=fields;query_args.trap=true;return wpNotesCommon.getNotes(query_args).done(function(res){var qt;var notes=res.notes;var notes_changed=false;if(!t.lastMarkedSeenTimestamp||(res.last_seen_time>t.lastMarkedSeenTimestamp)){notes_changed=true;t.lastMarkedSeenTimestamp=parseInt(res.last_seen_time,10);}
for(var idx in notes){var note_model=t.get(notes[idx].id);if(note_model){if(typeof(notes[idx].subject)!='object'){t.remove(notes[idx].id);notes_changed=true;continue;}
if(type){qt=note_model.get('queried_types')||{};qt[type]=true;notes[idx].queried_types=qt;}
note_model.set(notes[idx]);}
else{if(typeof(notes[idx].subject)!='object'){continue;}
if(type){qt={};qt[type]=true;notes[idx].queried_types=qt;}
note_model=new wpNoteModel(notes[idx]);t.add(note_model);}
if(!note_model.has('body'))
t.allBodiesLoaded=false;notes_changed=true;}
if(t.maxNotes){while(t.length>t.maxNotes){t.pop();}}
if(notes_changed){t.sort();t.trigger('loadNotes:change');}
t.loading=false;t.hasLoaded=true;t.trigger('loadNotes:endLoading');}).fail(function(e){t.loading=false;t.trigger('loadNotes:failed');});},loadNoteBodies:function(filter){var t=this;if(t.allBodiesLoaded){return(new $.Deferred()).resolve();}
var ids=t.getNoteIds(filter);if(0==ids.length){return(new $.Deferred()).reject();}
var doneFunc=function(res){var notes=res.notes;for(var idx in notes){if(typeof(notes[idx].subject)!='object'){continue;}
var note_model=t.get(notes[idx].id);if(note_model){note_model.set(notes[idx]);}else{note_model=new wpNoteModel(notes[idx]);t.add(note_model);}}};var failFunc=function(e){if(typeof console!='undefined'&&typeof console.error=='function')
console.error('body loading error!');}
var deferreds=[];var count=3
for(var i=0;i<count;i++){if(typeof ids[i]=='undefined')
break;var query_params={};query_params.fields='id,type,unread,noticon,timestamp,subject,body,meta,status';query_params.trap=true;query_params['ids['+i+']']=ids[i];deferreds.push(wpNotesCommon.getNotes(query_params)
.done(doneFunc)
.fail(failFunc));}
if(ids.length>count){var query_params={};query_params.fields='id,type,unread,noticon,timestamp,subject,body,meta,status';query_params.trap=true;for(var i=count;i<ids.length;i++)
query_params['ids['+i+']']=ids[i];deferreds.push(wpNotesCommon.getNotes(query_params)
.done(doneFunc)
.fail(failFunc));}
var all_xhr=$.when.apply(null,deferreds);all_xhr.done(function(){if(typeof filter!='function'){t.allBodiesLoaded=true;}});return all_xhr;},markNotesSeen:function(){var t=this,mostRecentTs=t.getMostRecentTimestamp();if(mostRecentTs>this.lastMarkedSeenTimestamp){wpNotesCommon.markNotesSeen(mostRecentTs).done(function(){t.lastMarkedSeenTimestamp=false;});}},unreadCount:function(){return this.reduce(function(num,note){return num+(note.get('unread')?1:0);},0);},numberNewNotes:function(){var t=this;if(!t.lastMarkedSeenTimestamp)
return 0;return t.getNewNotes().length;},getNewNotes:function(){var t=this;return t.filter(function(note){return(note.get('timestamp')>t.lastMarkedSeenTimestamp);});},getUnreadNotes:function(){return this.filter(function(note){return Boolean(parseInt(note.get("unread"),10));});},getNotesOfType:function(typeName){var t=this;switch(typeName){case'unread':return t.getUnreadNotes();case'latest':return t.filter(function(note){var qt=note.get('queried_types');return'undefined'!=typeof qt&&'undefined'!=typeof qt.latest&&qt.latest;});default:return t.filter(function(note){var note_type=note.get("type");if("undefined"==typeof wpNotesCommon.noteTypes[typeName]){return false;}
else if("string"==typeof wpNotesCommon.noteTypes[typeName]){return typeName==note_type;}
var len=wpNotesCommon.noteTypes[typeName].length;for(var i=0;i<len;i++){if(wpNotesCommon.noteTypes[typeName][i]==note_type){return true;}}
return false;});}},getNoteIds:function(filter){if(typeof filter!='function')
filter=function(){return true;};return _.pluck(this.filter(filter),'id');}});wpNotesCommentModView=Backbone.View.extend({mode:'buttons',actionsByName:null,possibleActions:['approve-comment','replyto-comment','like-comment','spam-comment','trash-comment','unapprove-comment','unlike-comment','unspam-comment','untrash-comment'],possibleStatuses:['approved','spam','trash','unapproved'],events:{'click .wpn-replyto-comment-button-open a':'openReply','click .wpn-comment-reply-button-close':'closeReply','click .wpn-comment-reply-button-send':'sendReply','click .wpn-like-comment-button a':'clickLikeComment','click .wpn-unlike-comment-button a':'clickLikeComment','click .wpn-approve-comment-button a':'clickModComment','click .wpn-unapprove-comment-button a':'clickModComment','click .wpn-spam-comment-button a':'clickModComment','click .wpn-unspam-comment-button a':'clickModComment','click .wpn-trash-comment-button a':'clickModComment','click .wpn-untrash-comment-button a':'clickModComment'},templateActions:'\
			{{#reply}}\
			<span class="{{reply.class}}">\
				<a href="#" title="{{reply.title}}" data-action-type="{{reply.actionType}}">{{reply.text}}</a>\
			</span>\
			{{/reply}}\
			{{#like}}\
			<span class="{{like.class}}">\
				<a href="#" title="{{like.title}}" data-action-type="{{like.actionType}}">{{like.text}}</a>\
			</span>\
			{{/like}}\
			<span class="wpn-more">\
				<a href="#">More</a>\
				<div class="wpn-more-container">\
				{{#spam}}\
				<span class="{{spam.class}}">\
					<a href="#" title="{{spam.title}}" data-action-type="{{spam.actionType}}">{{spam.text}}</a>\
				</span>\
				{{/spam}}\
				{{#trash}}\
				<span class="{{trash.class}}">\
					<a href="#" title="{{trash.title}}" data-action-type="{{trash.actionType}}">{{trash.text}}</a>\
				</span>\
				{{/trash}}\
				</div>\
			</span>\
			{{#approve}}\
			<span class="{{approve.class}}">\
				<a href="#" title="{{approve.title}}" data-action-type="{{approve.actionType}}">{{approve.text}}</a>\
			</span>\
			{{/approve}}\
			<span class="wpn-comment-mod-waiting"></span>',templateReply:'\
			<div class="wpn-note-comment-reply">\
				<h5>{{reply_header_text}}</h5>\
				<textarea class="wpn-note-comment-reply-text" rows="5" cols="45" name="wpn-note-comment-reply-text"></textarea>\
				<p class="wpn-comment-submit">\
					<span class="wpn-comment-submit-waiting" style="display: none;"></span>\
				<span class="wpn-comment-submit-error" style="display:none;">Error!</span>\
				<a href="#" class="wpn-comment-reply-button-send alignright">{{submit_button_text}}</a>\
				<a href="#" class="wpn-comment-reply-button-close alignleft">_</a>\
				</p>\
			</div>',initialize:function(){var _this=this;this.setElement($('<div class="wpn-note-comment-actions" />'));this.listenTo(this.model,'change:status',function(model,status){var approvalStatus,prevStatus;approvalStatus=status.approval_status;prevStatus=model.previous('status')||{};if(prevStatus.approval_status&&prevStatus.approval_status===approvalStatus){return;}
if(approvalStatus.match(/^trash|spam$/)){return _this.setUndoStatus(prevStatus.approval_status);}});this.listenTo(this.model,'change',this.render);$(document).on('click','.wpn-more > a',function(ev){var $el;ev.preventDefault();ev.stopPropagation();if(ev.doneMoreToggle){return;}
ev.doneMoreToggle=true;$el=$(ev.currentTarget);$el.parent().find('.wpn-more-container').toggle();return false;});this;$(document).on('click','.wpn-note-body',function(ev){var $el,$note;$el=$(ev.target);if(($el.parents('.wpn-more').length)){return;}
$note=$el.closest('.wpn-note-body');if($note.find('.wpn-more-container').is(':visible')){$note.find('.wpn-more-container').toggle();}});this;$('.wpn-more-container:not(:has(*))').parents('.wpn-more').hide();$(document).on('keydown',function(keyEvent){var keyCode,status,validActions;if(_this.$el.is(':hidden')){return;}
if(_this.mode!=='buttons'){return;}
keyCode=wpNotesCommon.getKeycode(keyEvent);if(!keyCode){return;}
validActions=_this.getValidActions();status=_this.model.get('status')||{};if(keyCode===82){if(_.contains(validActions,'replyto-comment')){_this.openReply(keyEvent);}}
if(keyCode===65){if(_.contains(validActions,'approve-comment')){_this.modComment('approve-comment');}else if(_.contains(validActions,'unapprove-comment')){_this.modComment('unapprove-comment');}}
if(keyCode===76){if(_.contains(validActions,'like-comment')){_this.likeComment('like-comment');}else if(_.contains(validActions,'unlike-comment')){_this.likeComment('unlike-comment');}}
if(keyCode===83){if(_.contains(validActions,'spam-comment')){_this.modComment('spam-comment');}else if(_.contains(validActions,'unspam-comment')){_this.modComment('unspam-comment');}}
if(keyCode===84){if(_.contains(validActions,'trash-comment')){_this.modComment('trash-comment');}else if(_.contains(validActions,'untrash-comment')){_this.modComment('untrash-comment');}}
return false;});return this;},render:function(){var body;if(this.model._changing&&'reply'===this.mode){return this;}
this.$el.empty();body=this.model.get('body');if(!body.actions){return this;}
this.updateActionsMap();if(this.mode==='buttons'){this.$el.html(this.createActionsHTML());}else{this.$el.html(this.createReplyBoxHTML());this.$('textarea').focus();}
this.delegateEvents();return this;},setUndoStatus:function(status){return this._undoStatus=status;},getUndoStatus:function(){var status;if(this._undoStatus){return this._undoStatus;}
status=this.model.get('status');if((status!=null)&&status.undo_status==='1'){return'approved';}
return'unapproved';},getValidActions:function(){var actions,status;status=this.model.get('status')||{};switch(status.approval_status){case'pending':case'unapproved':return['replyto-comment','approve-comment','spam-comment','trash-comment'];case'approved':actions=['replyto-comment','unapprove-comment','spam-comment','trash-comment'];if(status.i_liked){actions.splice(1,0,'unlike-comment');}else{actions.splice(1,0,'like-comment');}
return actions;case'trash':return['untrash-comment'];case'spam':return['unspam-comment'];default:return[];}},getResultantStatus:function(actionType){switch(actionType){case'approve-comment':return'approved';case'unapprove-comment':return'unapproved';case'spam-comment':return'spam';case'trash-comment':return'trash';case'unspam-comment':case'untrash-comment':return this.getUndoStatus();default:return void 0;}},getStatusParamFromActionType:function(actionType){if(!actionType){return void 0;}
switch(actionType){case'approve-comment':return'approved';case'unapprove-comment':return'unapproved';default:return actionType.split('-')[0];}},getComplementaryActionType:function(actionType){switch(actionType){case'approve-comment':return'unapprove-comment';case'unapprove-comment':return'approve-comment';case'like-comment':return'unlike-comment';case'unlike-comment':return'like-comment';case'spam-comment':return'unspam-comment';case'trash-comment':return'untrash-comment';case'unspam-comment':return'spam-comment';case'untrash-comment':return'trash-comment';default:return void 0;}},getTranslation:function(string){if(typeof notes_i18n==='undefined'||!notes_i18n.translate){return string;}
return notes_i18n.translate(string).fetch();},getTranslationsForActionType:function(actionType){var gt;gt=this.getTranslation;if(!this._translationsByActionType){this._translationsByActionType={'approve-comment':{buttonText:gt('Approve'),titleText:gt('Approve this comment.')},'like-comment':{buttonText:gt('Like'),titleText:gt('Like this comment.')},'replyto-comment':{buttonText:gt('Reply'),titleText:gt('Reply to this comment.')},'spam-comment':{buttonText:gt('Spam'),titleText:gt('Mark this comment as spam.')},'trash-comment':{buttonText:gt('Trash'),titleText:gt('Move this comment to the trash.')},'unapprove-comment':{buttonText:gt('Unapprove'),titleText:gt('Unapprove this comment.')},'unlike-comment':{buttonText:gt('Liked'),titleText:gt('Unlike this comment.')},'unspam-comment':{buttonText:gt('Unspam'),titleText:gt('Unmark this comment as spam.')},'untrash-comment':{buttonText:gt('Untrash'),titleText:gt('Restore this comment from the trash.')}};}
return this._translationsByActionType[actionType];},updateActionsMap:function(){var action,actionType,actions,body,_fn,_i,_j,_len,_len1,_ref,_results,_this=this;body=this.model.get('body');actions=body.actions||[];this.actionsByName=this.actionsByName||{};_fn=function(action){if(!action.type||!action.params){return;}
return _this.actionsByName[action.type]=$.extend({},action.params,{actionType:action.type});};for(_i=0,_len=actions.length;_i<_len;_i++){action=actions[_i];_fn(action);}
_ref=this.possibleActions;_results=[];for(_j=0,_len1=_ref.length;_j<_len1;_j++){actionType=_ref[_j];_results.push((function(actionType){var actionObj,complementObj,status,statusParam,submitText,translations;actionObj=_this.actionsByName[actionType];statusParam=_this.getStatusParamFromActionType(actionType);translations=_this.getTranslationsForActionType(actionType);if(!actionObj){complementObj=_this.actionsByName[_this.getComplementaryActionType(actionType)];if(complementObj){_this.actionsByName[actionType]=$.extend({},complementObj,{actionType:actionType,ajax_arg:statusParam,rest_body:{status:statusParam},text:translations.buttonText,title_text:translations.titleText});}}
if(actionType==='replyto-comment'){status=_this.model.get('status'||{});submitText=status.approval_status==='approved'?_this.getTranslation('Reply'):_this.getTranslation('Approve and Reply');return $.extend(_this.actionsByName['replyto-comment'],{button_text:translations.buttonText,submit_button_text:submitText,text:translations.buttonText,title_text:translations.titleText});}})(actionType));}
return _results;},createActionsHTML:function(){var actionType,status,templateData,_fn,_i,_len,_ref,_this=this;status=this.model.get('status').approval_status;templateData={};_ref=this.getValidActions();_fn=function(actionType){var action,button_data;action=_this.actionsByName[actionType];if(!action){return;}
button_data={"class":'wpn-'+actionType+'-button',"actionType":actionType,"text":action.text||action.button_text};switch(actionType){case'replyto-comment':return templateData.reply=$.extend({},button_data,{"class":'wpn-replyto-comment-button-open',"title":(action.title_text||action.button_title_text)+' [r]'});case'like-comment':case'unlike-comment':return templateData.like=$.extend({},button_data,{"title":(action.title_text||action.button_title_text)+' [l]'});case'approve-comment':case'unapprove-comment':if(_.contains(['spam','trash'],status)){break;}
return templateData.approve=$.extend({},button_data,{"title":(action.title_text||action.button_title_text)+' [a]'});case'spam-comment':case'unspam-comment':if(status==='trash'){break;}
return templateData.spam=$.extend({},button_data,{"title":(action.title_text||action.button_title_text)+' [s]'});case'trash-comment':case'untrash-comment':if(status==='spam'){break;}
return templateData.trash=$.extend({},button_data,{"title":(action.title_text||action.button_title_text)+' [t]'});}};for(_i=0,_len=_ref.length;_i<_len;_i++){actionType=_ref[_i];_fn(actionType);}
return Mustache.render(this.templateActions,templateData);},createReplyBoxHTML:function(){var action,blog_id,comment_id;action=this.actionsByName['replyto-comment'];if(!action){return;}
blog_id=action.site_id||0;comment_id=this.model.id||0;return Mustache.render(this.templateReply,{reply_header_text:action.reply_header_text,submit_button_text:action.submit_button_text});},closeReply:function(ev){if(ev){ev.preventDefault();}
this.mode='buttons';this.model.currentReplyText=this.$el.children('.wpn-note-comment-reply').children('.wpn-note-comment-reply-text').val();this.render();return this.model.resize();},openReply:function(ev){var action,gettingMentions,query_args,_this=this;if(ev){ev.preventDefault();}
this.mode='reply';this.render();this.$el.children('.wpn-note-comment-reply').children('.wpn-note-comment-reply-text').val(this.model.currentReplyText);$('.selected .wpn-note-body p.submitconfirm').remove();this.model.resize();if(!window.mentionDataCache){window.mentionDataCache=[];}
action=this.actionsByName['replyto-comment'];if(action.site_id!=null){if(window.mentionDataCache[action.site_id]!=null){return this.$el.children('.wpn-note-comment-reply').children('.wpn-note-comment-reply-text').mentions(window.mentionDataCache[action.site_id]);}else{window.mentionDataCache[action.site_id]=[];query_args={site_id:action.site_id,client:'notes-widget'};gettingMentions=wpNotesCommon.getMentions(query_args);return gettingMentions.done(function(res){window.mentionDataCache[action.site_id]=res.suggestions;return _this.$el.children('.wpn-note-comment-reply').children('.wpn-note-comment-reply-text').mentions(window.mentionDataCache[action.site_id]);});}}},sendReply:function(ev){var $submitWrap,action,blog_id,comment_id,comment_reply_el,content,doSend,_this=this;if(ev){ev.preventDefault();}
action=this.actionsByName['replyto-comment'];if(!action){return $.Deferred().reject('Invalid replyto-comment action');}
comment_reply_el=this.$el.children('.wpn-note-comment-reply');this.model.currentReplyText=comment_reply_el.children('.wpn-note-comment-reply-text').val();blog_id=action.site_id||0;comment_id=action.comment_id||0;content=this.model.currentReplyText||0;if(!(blog_id&&comment_id&&content)){return $.Deferred().reject('Invalid sendReply params');}
$submitWrap=comment_reply_el.children('.wpn-comment-submit');$submitWrap.children('.wpn-comment-submit-error').hide();$submitWrap.children('.wpn-comment-reply-button-send').hide();$submitWrap.children('.wpn-comment-submit-waiting').gifspin('small').show();wpNotesCommon.bumpStat('notes-click-action','replyto-comment');doSend=function(){return wpNotesCommon.ajax({type:'POST',path:'/sites/'+blog_id+'/comments/'+comment_id+'/replies/new',data:{content:content},success:function(r){if(typeof r==='string'){_this.errorReply(r);return false;}
_this.closeReply();_this.model.currentReplyText='';return _this.model.reload(true).done(function(){var tries;if(!_this.model.get('status').i_replied){tries=0;return _this.replyCommentInterval=setInterval(function(){return _this.model.reload(true).done(function(){if(_this.model.get('status').i_replied||tries++>=10){return clearInterval(_this.replyCommentInterval);}});},3000);}});},error:function(r){return _this.errorReply(r);}}).done(function(){var commentPermalink,submitConfirm;commentPermalink=$('.selected .wpn-comment-date a').attr('href');submitConfirm='<p class="submitconfirm"><strong>';submitConfirm+=notes_i18n.translate('Reply successful, <a %s>view thread</a>').fetch('target="_blank" href="'+commentPermalink+'"');submitConfirm+='</strong></p>';return $('.selected .wpn-note-body').append(submitConfirm);});};if(this.model.get('status').approval_status!=='approved'){return this.modComment('approve-comment').done(doSend);}else{return doSend();}},errorReply:function(r){var comment_reply_el,er,o;er=r;if(typeof r==='object'){if(r.responseText){o=$.parseJSON(r.responseText);er=o.error+': '+o.message;}else if(r.statusText){er=r.statusText;}else{er='Unknown Error';}}
comment_reply_el=this.$el.children('.wpn-note-comment-reply');comment_reply_el.children('.wpn-comment-submit').children('.wpn-comment-submit-waiting').hide();if(er){return comment_reply_el.children('.wpn-comment-submit').children('.wpn-comment-submit-error').text(er).show();}},clickModComment:function(ev){if(ev){ev.preventDefault();}else{return $.Deferred.reject('invalid click event');}
return this.modComment($(ev.currentTarget).data('action-type'));},modComment:function(actionType){var moderating,_this=this;this.$('.wpn-comment-mod-waiting').show().gifspin('small');moderating=$.Deferred().always(function(){return _this.$('.wpn-comment-mod-waiting').empty().hide();}).fail(function(error,code){if((typeof console!=="undefined"&&console!==null)&&typeof console.error==='function'){console.error('Comment moderation error');if(error){console.error(error);}}
if(!code||code!=='too_soon'){return _this.model.reload();}});if(this.modPromise&&typeof this.modPromise.state==='function'&&this.modPromise.state()==='pending'){moderating.always(function(){return _this.$('.wpn-comment-mod-waiting').show().gifspin('small');});return moderating.reject('Moderation already in progress','too_soon');}
this.modPromise=moderating.promise();if(!actionType||!actionType.length||!_.contains(this.getValidActions(),actionType)){return moderating.reject('Invalid actionType');}
$.Deferred(function(){var action,anticipatedNewStatus;wpNotesCommon.bumpStat('notes-click-action',actionType);action=_this.actionsByName[actionType];if(!action){return moderating.reject('Undefined action params for type: '+actionType);}
anticipatedNewStatus=_this.getResultantStatus(actionType);if(anticipatedNewStatus){_this.model.set('status',$.extend({},_this.model.get('status'),{approval_status:anticipatedNewStatus}));_this.$('.wpn-comment-mod-waiting').show().gifspin('small');}
return wpNotesCommon.ajax({type:'POST',path:action.rest_path,data:action.rest_body}).done(function(r){var rStatus;rStatus=(r!=null?r.status:void 0)?r.status:'undefined';if(_.contains(_this.possibleStatuses,rStatus)){_this.model.set('status',$.extend({},_this.model.get('status'),{approval_status:rStatus}));_this.model.blockReloading(15);return moderating.resolve();}else{return moderating.reject('Invalid status: "'+rStatus+'" received from moderation POST');}}).fail(function(error){return moderating.reject(error);});});return this.modPromise;},clickLikeComment:function(ev){var $button,actionType;ev.preventDefault();$button=$(ev.currentTarget);actionType=$button.data('action-type');return this.likeComment(actionType);},likeComment:function(actionType){var action,i_liked,rest_path,_this=this;action=this.actionsByName[actionType];if('like-comment'===actionType){i_liked=true;rest_path=action.rest_path+'new/';}else{i_liked=false;rest_path=action.rest_path+'mine/delete/';}
this.model.set('status',$.extend({},this.model.get('status'),{i_liked:i_liked}));this.$('.wpn-comment-mod-waiting').show().gifspin('small');return wpNotesCommon.ajax({type:'POST',path:rest_path}).done(function(r){return _this.$('.wpn-comment-mod-waiting').empty().hide();});}});})(jQuery);(function(){(function(window,$){return $.fn.gifspin=function(size){var $el,$spinner,len;$el=$(this);if(_.isFinite(size)&&size>0){len=Math.min(~~size,128);}else{switch(size){case'tiny':len=8;break;case'small':len=16;break;case'medium':len=32;break;case'large':len=64;break;default:len=128;}}
$spinner=$('<img class="gifspinner" src="//s0.wp.com/wp-content/mu-plugins/notes/images/loading.gif" />');$spinner.css({height:len,width:len});$el.html($spinner);return $el;};})(typeof exports!=="undefined"&&exports!==null?exports:this,window.jQuery);}).call(this);
if('undefined'==typeof wpcom){wpcom={};}
if('undefined'==typeof wpcom.events){wpcom.events=_.extend({},Backbone.Events);}
(function($){var __autoCacheBusterNotesPanel='@automattic/jetpack-blocks@13.1.0-12669-g727d23c131';var wpNotesArgs=window.wpNotesArgs||{},cacheBuster=wpNotesArgs.cacheBuster||__autoCacheBusterNotesPanel,iframeUrl=wpNotesArgs.iframeUrl||'https://widgets.wp.com/notes/',iframeAppend=wpNotesArgs.iframeAppend||'',iframeScroll=wpNotesArgs.iframeScroll||"no",wideScreen=wpNotesArgs.wide||false,hasToggledPanel=false,iframePanelId,iframeFrameId;var wpntView=Backbone.View.extend({el:'#wp-admin-bar-notes',hasUnseen:null,initialLoad:true,count:null,iframe:null,iframeWindow:null,messageQ:[],iframeSpinnerShown:false,isJetpack:false,linkAccountsURL:false,currentMasterbarActive:false,initialize:function(){var t=this;var matches=navigator.appVersion.match(/MSIE (\d+)/);if(matches&&parseInt(matches[1],10)<8){var $panel=t.$('#'+iframePanelId);var $menuItem=t.$('.ab-empty-item');if(!$panel.length||!$menuItem.length){return;}
var offset=t.$el.offset();t.$('.ab-item').removeClass('ab-item');t.$('#wpnt-notes-unread-count').html('?');$panel.html(' \
					<div class="wpnt-notes-panel-header"><p>Notifications are not supported in this browser!</p> </div> \
					<img src="http://i2.wp.com/wordpress.com/wp-content/mu-plugins/notes/images/jetpack-notes-2x.png" /> \
					<p class="wpnt-ie-note"> \
					Please <a href="http://browsehappy.com" target="_blank">upgrade your browser</a> to keep using notifications. \
					</p>').addClass('browse-happy');t.$el.on('mouseenter',function(e){clearTimeout(t.fadeOutTimeout);if($panel.is(':visible:animated')){$panel.stop().css('opacity','');}
$menuItem.css({'background-color':'#eee'});$panel.show();});t.$el.on('mouseleave',function(){t.fadeOutTimeout=setTimeout(function(){clearTimeout(t.fadeOutTimeout);if($panel.is(':animated')){return;}
$panel.fadeOut(250,function(){$menuItem.css({'background-color':'transparent'});});},350);});return;}
if('function'!=typeof $.fn.spin){$.fn.spin=function(x){};}
this.isRtl=$('#wpadminbar').hasClass('rtl');this.count=$('#wpnt-notes-unread-count');this.panel=$('#'+iframePanelId);this.hasUnseen=this.count.hasClass('wpn-unread');if('undefined'!=typeof wpNotesIsJetpackClient&&wpNotesIsJetpackClient)
t.isJetpack=true;if(t.isJetpack&&'undefined'!=typeof wpNotesLinkAccountsURL)
t.linkAccountsURL=wpNotesLinkAccountsURL;this.$el.children('.ab-item').on('click touchstart',function(e){e.preventDefault();t.togglePanel();return false;});this.preventDefault=function(e){if(e)e.preventDefault();return false;};if(iframeAppend=='2'){this.panel.mouseenter(function(){document.body.addEventListener('mousewheel',t.preventDefault);});this.panel.mouseleave(function(){document.body.removeEventListener('mousewheel',t.preventDefault);});if(typeof document.hidden!=='undefined'){document.addEventListener('visibilitychange',function(){t.postMessage({action:"toggleVisibility",hidden:document.hidden});});}}
$(document).bind("mousedown focus",function(e){var $clicked;if(!t.showingPanel)
return true;$clicked=$(e.target);if($clicked.is(document))
return true;if($clicked.closest('#wp-admin-bar-notes').length)
return true;t.hidePanel();return false;});$(document).on('keydown.notes',function(e){var keyCode=wpNotesCommon.getKeycode(e);if(!keyCode)
return;if((keyCode==27))
t.hidePanel();if((keyCode==78))
t.togglePanel();if(this.iframeWindow===null)
return;if(t.showingPanel&&((keyCode==74)||(keyCode==40))){t.postMessage({action:"selectNextNote"});return false;}
if(t.showingPanel&&((keyCode==75)||(keyCode==38))){t.postMessage({action:"selectPrevNote"});return false;}
if(t.showingPanel&&((keyCode==82)||(keyCode==65)||(keyCode==83)||(keyCode==84))){t.postMessage({action:"keyEvent",keyCode:keyCode});return false;}
});wpcom.events.on('notes:togglePanel',function(){t.togglePanel();});if(t.isJetpack)
t.loadIframe();else{setTimeout(function(){t.loadIframe();},3000);}
if(t.count.hasClass('wpn-unread'))
wpNotesCommon.bumpStat('notes-menu-impressions','non-zero');else
wpNotesCommon.bumpStat('notes-menu-impressions','zero');$(window).on('message',function(event){if(!event.data&&event.originalEvent.data){event=event.originalEvent;}
if(event.origin!='https://widgets.wp.com'){return;}
try{var data=('string'==typeof event.data)?JSON.parse(event.data):event.data;if(data.type!='notesIframeMessage'){return;}
t.handleEvent(data);}catch(e){}});},handleEvent:function(event){var inNewdash=('undefined'!==typeof wpcomNewdash&&'undefined'!==typeof wpcomNewdash.router&&'undefined'!==wpcomNewdash.router.setRoute);if(!event||!event.action){return;}
switch(event.action){case"togglePanel":this.togglePanel();break;case"render":this.render(event.num_new,event.latest_type);break;case"renderAllSeen":this.renderAllSeen();break;case"iFrameReady":this.iFrameReady(event);break;case"goToNotesPage":if(inNewdash){wpcomNewdash.router.setRoute('/notifications');}else{window.location.href='//wordpress.com/me/notifications/';}
break;case"widescreen":var iframe=$('#'+iframeFrameId);if(event.widescreen&&!iframe.hasClass('widescreen')){iframe.addClass('widescreen');}else if(!event.widescreen&&iframe.hasClass('widescreen')){iframe.removeClass('widescreen');}
break;}},render:function(num_new,latest_type){var t=this,flash=false;if((false===this.hasUnseen)&&(0===num_new))
return;if(this.initialLoad&&this.hasUnseen&&(0!==num_new)){this.initialLoad=false;return;}
if(!this.hasUnseen&&(0!==num_new)){wpNotesCommon.bumpStat('notes-menu-impressions','non-zero-async');}
var latest_icon_type=wpNotesCommon.noteType2Noticon[latest_type];if(typeof latest_icon_type=='undefined')
latest_icon_type='notification';var latest_img_el=$('<span/>',{'class':'noticon noticon-'+latest_icon_type+''});var status_img_el=this.getStatusIcon(num_new);if(0===num_new||this.showingPanel){this.hasUnseen=false;t.count.fadeOut(200,function(){t.count.empty();t.count.removeClass('wpn-unread').addClass('wpn-read');t.count.html(status_img_el);t.count.fadeIn(500);});if(wpcom&&wpcom.masterbar){wpcom.masterbar.hasUnreadNotifications(false);}}else{if(this.hasUnseen){t.count.fadeOut(400,function(){t.count.empty();t.count.removeClass('wpn-unread').addClass('wpn-read');t.count.html(latest_img_el);t.count.fadeIn(400);});}
this.hasUnseen=true;t.count.fadeOut(400,function(){t.count.empty();t.count.removeClass('wpn-read').addClass('wpn-unread');t.count.html(latest_img_el);t.count.fadeIn(400,function(){});});if(wpcom&&wpcom.masterbar){wpcom.masterbar.hasUnreadNotifications(true);}}},renderAllSeen:function(){if(!this.hasToggledPanel){return;}
var img_el=this.getStatusIcon(0);this.count.removeClass('wpn-unread').addClass('wpn-read');this.count.empty();this.count.html(img_el);this.hasUnseen=false;if(wpcom&&wpcom.masterbar){wpcom.masterbar.hasUnreadNotifications(false);}},getStatusIcon:function(number){var new_icon='';switch(number){case 0:new_icon='noticon noticon-notification';break;case 1:new_icon='noticon noticon-notification';break;case 2:new_icon='noticon noticon-notification';break;default:new_icon='noticon noticon-notification';}
return $('<span/>',{'class':new_icon});},togglePanel:function(){if(!this.hasToggledPanel){this.hasToggledPanel=true;}
var t=this;this.loadIframe();this.$el.toggleClass('wpnt-stayopen');this.$el.toggleClass('wpnt-show');this.showingPanel=this.$el.hasClass('wpnt-show');$('.ab-active').removeClass('ab-active');if(this.showingPanel){var $unread=this.$('.wpn-unread');if($unread.length){$unread.removeClass('wpn-unread').addClass('wpn-read');}
this.reportIframeDelay();if(this.hasUnseen)
wpNotesCommon.bumpStat('notes-menu-clicks','non-zero');else
wpNotesCommon.bumpStat('notes-menu-clicks','zero');this.hasUnseen=false;}
this.postMessage({action:"togglePanel",showing:this.showingPanel});var focusNotesIframe=function(iframe){if(null===iframe.contentWindow){iframe.addEventListener('load',function(){iframe.contentWindow.focus();});}else{iframe.contentWindow.focus();}};if(this.showingPanel){focusNotesIframe(this.iframe[0]);}else{window.focus();}
this.setActive(this.showingPanel);},setActive:function(active){if(active){this.currentMasterbarActive=$('.masterbar li.active');this.currentMasterbarActive.removeClass('active');this.$el.addClass('active');}else{this.$el.removeClass('active');this.currentMasterbarActive.addClass('active');this.currentMasterbarActive=false;}
this.$el.find('a').first().blur();},loadIframe:function(){var t=this,args=[],src,lang,queries,panelRtl;if(t.iframe===null){t.panel.addClass('loadingIframe');if(t.isJetpack){args.push('jetpack=true');if(t.linkAccountsURL){args.push('link_accounts_url='+escape(t.linkAccountsURL));}}
if(('ontouchstart'in window)||window.DocumentTouch&&document instanceof DocumentTouch){t.panel.addClass('touch');}
panelRtl=$('#'+iframePanelId).attr('dir')=='rtl';lang=$('#'+iframePanelId).attr('lang')||'en';args.push('v='+cacheBuster);args.push('locale='+lang);queries=(args.length)?'?'+args.join('&'):'';src=iframeUrl;if(iframeAppend=='2'&&(t.isRtl||panelRtl)&&!/rtl.html$/.test(iframeUrl)){src=iframeUrl+'rtl.html';}
src=src+queries+'#'+document.location.toString();if($('#'+iframePanelId).attr('dir')=='rtl'){src+='&rtl=1';}
if(!lang.match(/^en/)){src+=('&lang='+lang);}
t.iframe=$('<iframe style="display:none" id="'+iframeFrameId+'" frameborder=0 ALLOWTRANSPARENCY="true" scrolling="'+iframeScroll+'"></iframe>');t.iframe.attr('src',src);if(wideScreen){t.panel.addClass('wide');t.iframe.addClass('wide');}
t.panel.append(t.iframe);}},reportIframeDelay:function(){if(!this.iframeWindow){if(!this.iframeSpinnerShown)
this.iframeSpinnerShown=(new Date()).getTime();return;}
if(this.iframeSpinnerShown!==null){var delay=0;if(this.iframeSpinnerShown)
delay=(new Date()).getTime()-this.iframeSpinnerShown;if(delay===0)
wpNotesCommon.bumpStat('notes_iframe_perceived_delay','0');else if(delay<1000)
wpNotesCommon.bumpStat('notes_iframe_perceived_delay','0-1');else if(delay<2000)
wpNotesCommon.bumpStat('notes_iframe_perceived_delay','1-2');else if(delay<4000)
wpNotesCommon.bumpStat('notes_iframe_perceived_delay','2-4');else if(delay<8000)
wpNotesCommon.bumpStat('notes_iframe_perceived_delay','4-8');else
wpNotesCommon.bumpStat('notes_iframe_perceived_delay','8-N');this.iframeSpinnerShown=null;}},iFrameReady:function(event){var t=this;var url_parser=document.createElement('a');url_parser.href=this.iframe.get(0).src;this.iframeOrigin=url_parser.protocol+'//'+url_parser.host;this.iframeWindow=this.iframe.get(0).contentWindow;if("num_new"in event)
this.render(event.num_new,event.latest_type);this.panel.removeClass('loadingIframe').find('.wpnt-notes-panel-header').remove();this.iframe.show();if(this.showingPanel)
this.reportIframeDelay();$(window).on('focus keydown mousemove scroll',function(){var now=(new Date()).getTime();if(!t.lastActivityRefresh||t.lastActivityRefresh<now-5000){t.lastActivityRefresh=now;t.postMessage({action:"refreshNotes"});}});this.sendQueuedMessages();},hidePanel:function(){if(this.showingPanel){this.togglePanel();}},postMessage:function(message){var t=this;try{var _msg=('string'==typeof message)?JSON.parse(message):message;if(!_.isObject(_msg)){return;}
_msg=_.extend({type:'notesIframeMessage'},_msg);var targetOrigin=this.iframeOrigin;if(this.iframeWindow&&this.iframeWindow.postMessage){this.iframeWindow.postMessage(JSON.stringify(_msg),targetOrigin);}else{this.messageQ.push(_msg);}}
catch(e){}},sendQueuedMessages:function(){var t=this;_.forEach(this.messageQ,function(m){t.postMessage(m);});this.messageQ=[];}});$(function(){if(($('#wpnt-notes-panel').length==0&&$('#wpnt-notes-panel2').length)&&('undefined'!=typeof wpNotesIsJetpackClientV2&&wpNotesIsJetpackClientV2)){iframeUrl='https://widgets.wp.com/notifications/';iframeAppend='2';iframeScroll='yes';wideScreen=true;}
iframePanelId="wpnt-notes-panel"+iframeAppend;iframeFrameId="wpnt-notes-iframe"+iframeAppend;new wpntView();});})(jQuery);