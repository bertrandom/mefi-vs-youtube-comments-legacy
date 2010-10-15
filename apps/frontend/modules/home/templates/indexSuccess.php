<div id="doc3" class="yui-t7">
<?php /*   <div id="hd"><h1>YUI: CSS Grid Builder</h1></div> */ ?>
   <div id="bd">
		<div class="yui-g">
		  <div class="yui-u first metafilter">
		  	<img src="/images/metafilter.png" />
				<ul class="comments">
					<?php include_partial('comments', array('posts' => $feeds['metafilter'])); ?>
				</ul>
		   </div>
		  <div class="yui-u">
		  	<img src="/images/youtube.gif" />
				<ul class="comments">
					<?php include_partial('comments', array('posts' => $feeds['youtube'])); ?>
				</ul>
		  </div>
		</div>
	</div>
  <div id="ft">Created by <a href="mailto:%62%65%72%74%72%61%6e%64@%66%61%6e.%6e%65%74">Bertrand Fan</a> using <a href="http://www.symfony-project.com">symfony</a> and <a href="http://pipes.yahoo.com">Yahoo Pipes</a>.</div>
</div>
