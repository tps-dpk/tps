<div id="Logo">
<img src="images/logo.jpg" alt="Logo" width="140" height="56" />
</div>

<div id="TPS_Head">
<h1>Task Planning System</h1>
</div>
<div id="Menue">
  <div id="OAWidget" class="yuimenubar yuimenubarnav">
	<div class="bd">
	<ul class="first-of-type">

<?php
session_start();
if (empty($_SESSION['username'])) {

echo <<<EOF
		<li class="yuimenubaritem"><a class="yuimenubaritemlabel" href="login.php">Anmelden</a>
		</li>
EOF;

}else {

echo <<<EOF
		<li class="yuimenubaritem"><a class="yuimenubaritemlabel" href="logout.php">Abmelden</a>
		</li>
		<li class="yuimenubaritem"><a class="yuimenubaritemlabel">Mitarbeiter</a>
	
			<div id="operator" class="yuimenu">
				<div class="bd">                                        
					<ul>
						<li class="yuimenuitem"><a class="yuimenuitemlabel" href="operator.php?function=hinzufuegen">Anlegen</a></li>
						<li class="yuimenuitem"><a class="yuimenuitemlabel" href="operator_list.php">Anzeigen</a></li>
					</ul>
				</div>
			</div>
		</li>
		
		<li class="yuimenubaritem"><a class="yuimenubaritemlabel">Kunde</a>
			<div id="custom" class="yuimenu">
				<div class="bd">                    
					<ul>
						<li class="yuimenuitem"><a class="yuimenuitemlabel" href="customer.php?function=hinzufuegen">Anlegen</a></li>
						<li class="yuimenuitem"><a class="yuimenuitemlabel" href="customer_list.php">Anzeigen</a></li>
					</ul>
				</div>
			</div>                    
		
		</li>
	
		<li class="yuimenubaritem"><a class="yuimenubaritemlabel">Auftrag</a>
	
			<div id="task" class="yuimenu">
				<div class="bd">                    
					<ul>
						<li class="yuimenuitem"><a class="yuimenuitemlabel" href="task.php?function=hinzufuegen">Anlegen</a></li>
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
<div id="user_info" align="right">
<?php 
if ( ! empty($_SESSION['username'])) {
	echo "<a>Benutzer:&nbsp;<i>".$_SESSION['username']."</i></a>"; 
}
?>
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
