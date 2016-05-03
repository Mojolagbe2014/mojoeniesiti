<div class="category_content responsiveCategoryMain">
 
     <?php
	//if((isset($_GET['countryid']) && $_GET['countryid'] == 38) || isset($_GET['stateid']) || isset($urlSate)){
		if(isset($url_country) || isset($urlSate)){
	?>
     <div class="sneak_peak2_category">
         <div class="button_class_category">Filter by states in Nigeria</div>
         
       
         
         </div>
     <div class="state_filter">

     <ul>
      <?php
	 $state =  MysqlSelectQuery("select * from states");
	  while($rowsState = SqlArrays($state)){
		  $stripState = str_replace(" ","-",strtolower($rowsState['name']));
	  ?>
      <li><a href="<?php echo SITE_URL.'state/'.$stripState;?>"><?php echo $rowsState['name'];?></a></li>
      <?php
	  }
	  ?>
 
     	 </ul>
 
       
     </div>
     <?php
	}
	 ?>

       <div class="sneak_peak2_category">
         <div class="button_class_category">Search Events by Category</div>
         
         <div class="triangle-r_side"></div>
         
         </div>
         
         
        <ul>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/administrative-and-secretarial">Administrative and Secretarial</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/agriculture-and-rural-development">Agriculture and Rural Development.</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/aviation-and-maritime">Aviation and Maritime</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/banking-and-insurance">Banking and Insurance</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/conferences-agm-seminars">Conferences AGM Seminars</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/corporate-governance">Corporate Governance</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/customer-service-and-support">Customer Service and Support</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/e-learning">E-Learning </a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/economic-management">Economic Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/education">Education</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/engineering-and-technical-skills">Engineering and Technical Skills</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/entrepreneurship-and-business-development">Entrepreneurship and Business Development</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/executive-education">Executive Education</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/finance-and-accounting">Finance and Accounting</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/general-management">General Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/health-and-hse">Health and HSE</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/human-resource-management">Human Resource Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/information-and-communications-technology">Information and Communications Technology</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/internal-audit-fraud">Internal Audit, Fraud </a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/leadership-and-self-development">Leadership and Self Development</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/legal-and-legislative">Legal and Legislative</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/logistics-and-supply-chain-management">Logistics and Supply Chain Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/management-consultancy">Management Consultancy</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/marketing-and-sales-management">Marketing and Sales Mgt</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/media-and-communication">Media and Communication</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/oil-and-gas-energy-and-power">Oil and Gas Energy and Power</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/operations-management">Operations Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/pre-retirement-and-new-beginnings">Pre-Retirement and New Beginnings</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/project-management">Project Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/public-administration">Public Administration</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/real-estate-management">Real Estate Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/research-methodology-and-analytics">Research Methodology and Analytics</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/risk-management">Risk Management </a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/security-and-crime-prevention">Security and Crime Prevention</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/strategic-management">Strategic Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/telecommunications">Telecommunications</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/time-and-self-management">Time and Self Management</a></h2></li>
            <li><h2 style="font-size:12px; font-weight:normal;"><a href="<?php echo SITE_URL;?>category/vocational-education-and-training">Vocational Education and Training</a></h2></li>
            
            <li><a href="<?php echo SITE_URL;?>events/countries/38/Nigeria" class="event_location">Events in Nigeria</a></li>
      <li><a href="<?php echo SITE_URL;?>events/countries" class="event_location">Events by Countries</a></li>
       <li><a href="<?php echo SITE_URL;?>training-providers/countries/38/Nigeria" class="event_location">Training Providers in  Nigeria</a></li>
         <li><a href="<?php echo SITE_URL;?>trainingCategory/spe?categories" class="event_location">Training Providers by Category</a></li>
       <li><a href="<?php echo SITE_URL;?>training-providers/countries" class="event_location">Training Providers by Countries</a></li>
      </ul>
 
  <div class="featuredVenue">
         <span class="span_cat span_title" >Useful Web Tools</span>
         <ul>
           <!-- <li><a href="#currency" class="currency" style="font-size:13px;" >Currency Converter</a></li>-->
            <li><a href="<?php echo SITE_URL;?>favicon-generator" style="font-size:13px;" >Favicon Generator</a></li>
             <li><a href="<?php echo SITE_URL;?>domain-checker" style="font-size:13px;" >Domain Name Checker</a></li>
            </ul>
    
         	</div>
            
           
         </div>
 
</div>