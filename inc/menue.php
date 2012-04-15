<div id="TPS_Head">
<h1>Task Planning System</h1>
</div>
<div id="OAWidget" class="yuimenubar yuimenubarnav">
	<div class="bd">
	<ul class="first-of-type">

<?php
if (empty($_SESSION['username'])) {

echo <<<EOF
		<li class="yuimenubaritem"><a class="yuimenubaritemlabel thickbox" href="public/login.htm?height=200&width=300">Anmelden</a>
		</li>
EOF;

}else {

echo <<<EOF
		<li class="yuimenubaritem"><a class="yuimenubaritemlabel thickbox" href="logout.php">Abmelden</a>
		</li>
		<li class="yuimenubaritem"><a class="yuimenubaritemlabel">OM</a>
	
			<div id="operator" class="yuimenu">
				<div class="bd">                                        
					<ul>
						<li class="yuimenuitem"><a class="yuimenuitemlabel" href="#operator_add">Anlegen</a></li>
						<li class="yuimenuitem"><a class="yuimenuitemlabel" href="operator_list.php">Anzeigen</a></li>
					</ul>
				</div>
			</div>
		</li>
		
		<li class="yuimenubaritem"><a class="yuimenubaritemlabel">Kunde</a>
			<div id="custom" class="yuimenu">
				<div class="bd">                    
					<ul>
						<li class="yuimenuitem"><a class="yuimenuitemlabel" href="#custom_add">Anlegen</a></li>
						<li class="yuimenuitem"><a class="yuimenuitemlabel" href="customer_list.php">Anzeigen</a></li>
					</ul>
				</div>
			</div>                    
		
		</li>
	
		<li class="yuimenubaritem"><a class="yuimenubaritemlabel">Aufgabe</a>
	
			<div id="task" class="yuimenu">
				<div class="bd">                    
					<ul>
						<li class="yuimenuitem"><a class="yuimenuitemlabel" href="#task_add">Anlegen</a></li>
						<li class="yuimenuitem"><a class="yuimenuitemlabel" href="task_list.php">Anzeigen</a></li>
					</ul>                    
				</div>
	
			</div>                                        
		
		</li>
EOF;
}
?>               
	</ul>            
	</div>
</div>


<script type="text/javascript">
(function() { 
  var cn = document.body.className.toString();
  if (cn.indexOf('yui-skin-sam') == -1) {
    document.body.className += " yui-skin-sam";
  }
})();

var initOAWidget = function() {
  /*
       Instantiate a Menu:  The first argument passed to the 
       constructor is the id of the element in the page 
       representing the Menu; the second is an object literal 
       of configuration properties.
  */

  var OAWidget = new YAHOO.widget.MenuBar("OAWidget",  { autosubmenudisplay: true, lazyload: true } );
    
  OAWidget.render();
};

// Create the YUI Menu when the HTML document is usable.
YAHOO.util.Event.onDOMReady(initOAWidget);
</script>
