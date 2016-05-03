<?php
require_once("../scripts/config.php");
require_once("../scripts/functions.php");
?>
<div class="addshadow" style="float:left;margin-top:10px">
<div class="sneak_peak2_category">
	<div class="button_class_category">
    	<h2 style="font-size:14px">Search Events by Category</h2>
    </div>
</div>
<ul>
<li><a href="<?php echo SITE_URL;?>administrative-and-secretarial" title="Administrative and Secretarial">Administrative and Secretarial</a></li>
<li><a href="<?php echo SITE_URL;?>agriculture-and-rural-development" title="Agriculture and Rural Development.">Agriculture and Rural Development.</a></li>
<li><a href="<?php echo SITE_URL;?>aviation-and-maritime" title="Aviation and Maritime">Aviation and Maritime</a></li>
<li><a href="<?php echo SITE_URL;?>banking-and-insurance" title="Banking and Insurance">Banking and Insurance</a></li>
<li><a href="<?php echo SITE_URL;?>conferences-agm-seminars" title="Conferences AGM Seminars">Conferences AGM Seminars</a></li>
<li><a href="<?php echo SITE_URL;?>corporate-governance" title="Corporate Governance">Corporate Governance</a></li>
<li><a href="<?php echo SITE_URL;?>customer-service-and-support" title="Customer Service and Support">Customer Service and Support</a></li>
<li><a href="<?php echo SITE_URL;?>e-learning" title="E-Learning">E-Learning </a></li>
<li><a href="<?php echo SITE_URL;?>economic-management" title="Economic Management">Economic Management</a></li>
<li><a href="<?php echo SITE_URL;?>education" title="Education">Education</a></li>
<li><a href="<?php echo SITE_URL;?>engineering-and-technical-skills" title="Engineering and Technical Skills">Engineering and Technical Skills</a></li>
<li><a href="<?php echo SITE_URL;?>entrepreneurship-and-business-development" title="Entrepreneurship and Business Development">Entrepreneurship and Business Development</a></li>
<li><a href="<?php echo SITE_URL;?>executive-education" title="Executive Education">Executive Education</a></li>
<li><a href="<?php echo SITE_URL;?>finance-and-accounting" title="Finance and Accounting">Finance and Accounting</a></li>
<li><a href="<?php echo SITE_URL;?>general-management" title="General Management">General Management</a></li>
<li><a href="<?php echo SITE_URL;?>health-and-hse" title="Health and HSE">Health and HSE</a></li>
<li><a href="<?php echo SITE_URL;?>human-resource-management" title="Human Resource Management">Human Resource Management</a></li>
<li><a href="<?php echo SITE_URL;?>information-and-communications-technology" title="Information and Communications Technology">Information and Communications Technology</a></li>
<li><a href="<?php echo SITE_URL;?>internal-audit-and-fraud" title="Internal Audit, Fraud">Internal Audit, Fraud </a></li>
<li><a href="<?php echo SITE_URL;?>leadership-and-self-development" title="Leadership and Self Development">Leadership and Self Development</a></li>
<li><a href="<?php echo SITE_URL;?>legal-and-legislative" title="Legal and Legislative">Legal and Legislative</a></li>
<li><a href="<?php echo SITE_URL;?>logistics-and-supply-chain-management" title="Logistics and Supply Chain Management">Logistics and Supply Chain Management</a></li>
<li><a href="<?php echo SITE_URL;?>management-consultancy" title="Management Consultancy">Management Consultancy</a></li>
<li><a href="<?php echo SITE_URL;?>marketing-and-sales-management" title="Marketing and Sales Mgt">Marketing and Sales Mgt</a></li>
<li><a href="<?php echo SITE_URL;?>media-and-communication" title="Media and Communication">Media and Communication</a></li>
<li><a href="<?php echo SITE_URL;?>oil-and-gas-energy-and-power" title="Oil and Gas Energy and Power">Oil and Gas Energy and Power</a></li>
<li><a href="<?php echo SITE_URL;?>operations-management" title="Operations Management">Operations Management</a></li>
<li><a href="<?php echo SITE_URL;?>pre-retirement-and-new-beginnings" title="Pre-Retirement and New Beginnings">Pre-Retirement and New Beginnings</a></li>
<li><a href="<?php echo SITE_URL;?>project-management" title="Project Management">Project Management</a></li>
<li><a href="<?php echo SITE_URL;?>public-administration" title="Public Administration">Public Administration</a></li>
<li><a href="<?php echo SITE_URL;?>real-estate-management" title="Real Estate Management">Real Estate Management</a></li>
<li><a href="<?php echo SITE_URL;?>research-methodology-and-analytics" title="Research Methodology and Analytics">Research Methodology and Analytics</a></li>
<li><a href="<?php echo SITE_URL;?>risk-management" title="Risk Management">Risk Management </a></li>
<li><a href="<?php echo SITE_URL;?>security-and-crime-prevention" title="Security and Crime Prevention">Security and Crime Prevention</a></li>
<li><a href="<?php echo SITE_URL;?>strategic-management" title="Strategic Management">Strategic Management</a></li>
<li><a href="<?php echo SITE_URL;?>telecommunications" title="Telecommunications">Telecommunications</a></li>
<li><a href="<?php echo SITE_URL;?>time-and-self-management" title="Time and Self Management">Time and Self Management</a></li>
<li><a href="<?php echo SITE_URL;?>vocational-education-and-training" title="Vocational Education and Training">Vocational Education and Training</a></li>
<li><h6 style="font-size:12px;font-weight:normal;"><a href="<?php echo SITE_URL;?>countries/nigeria" title="Events in Nigeria">Events in Nigeria</a></h6></li>
<li><h6 style="font-size:12px;font-weight:normal;"><a href="<?php echo SITE_URL;?>events/countries" title="Events by Countries">Events by Countries</a></h6></li>
<li><h6 style="font-size:12px;font-weight:normal;"><a href="<?php echo SITE_URL;?>training-provider/countries/nigeria" title="Training Providers in  Nigeria">Training Providers in Nigeria</a></h6></li>
<li><h6 style="font-size:12px;font-weight:normal;"><a href="<?php echo SITE_URL;?>trainingspe?categories" title="Training Providers by Category">Training Providers by Category</a></h6></li>
<li><h6 style="font-size:12px;font-weight:normal;"><a href="<?php echo SITE_URL;?>training-providers/countries" title="Training Providers by Countries">Training Providers by Countries</a></h6></li>
</ul>
</div>
<?php
if(isset($_POST['index'])){
	?>
<div id="venuProviders" style="float:left">
<div class="respond">
       <div class="featuredVenue " style="margin-top:5px;">
         <span class="span_cat addshadow"><i class="fa fa-star"></i>Featured Venue Providers</span>
      
          <?php echo GetFeaturedVenue();?>
         </div>
         
         <div class="featuredVenue">
         <span class="span_cat addshadow"><i class="fa fa-star"></i>Featured Equipment Suppliers</span>
        
          <?php echo GetFeaturedSupplier();?>
         </div>
       <!--<div class="featuredVenue">
         <span class="span_cat span_title"><i class="fa fa-star"></i>Featured Event Managers </span>
        
          <?php //echo GetFeaturedSupplier();?>
         	</div>
         </div>-->
          <div class="featuredVenue">
         <span class="span_cat addshadow"><i class="fa fa-star"></i>Featured Training Providers </span>
        
          <?php echo GetFeaturedTrainingProvider();?>
         	</div>
         </div>
</div>
<?php
}
?>
<div class="featuredVenue addshadow" style="float:left; margin-bottom:10px;">
	<div class="sneak_peak2_category">
		<div class="button_class_category">
        	Useful Web Tools
		</div>
	</div>
<ul>
<li><a href="javascript:void(0);" class="currency" data-id="#currency" style="font-size:13px" title="Currency Converter">Currency Converter</a></li>
<li><a href="favicon-generator" style="font-size:13px" title="Favicon Generator">Favicon Generator</a></li>
<li><a href="domain-checker" style="font-size:13px" title="Domain Name Checker">Domain Name Checker</a></li>
<li><a href="weather" style="font-size:13px" title="Check Weather Report">Check Weather Report</a></li>
<li><a href="<?php echo SITE_URL;?>install-widget" style="font-size:13px" title="Install Widget" target="_blank">Install Training Widget</a></li>
	</ul>
</div>