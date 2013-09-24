<!-- testing github -->
<?php
session_start();
include "labform.php";
include "conf/config.inc";
//modified by MHA
global $labConfig,$successMsg;

$tableName = 'labasd_demographics';
if($_REQUEST['search_id']){
	if(checkUserHasPermission($tableName, $_REQUEST['search_id']) && checkTableRowExistsId($tableName, $_REQUEST['search_id'])){
		$result = getTableDataQueryId($tableName, $_REQUEST['search_id']);
		if(mysql_num_rows($result)>0){
			$row1 = mysql_fetch_assoc($result);
			foreach($row1 as $key=>$val){
				${
					$key} = $val;
			}
		}
	}else{
		header("Location:welcome.php");
	}
}
?>
<html>
	<head>
	<link rel="stylesheet" type="text/css" href="css/ivory.css" media="all">
	<link rel="stylesheet" type="text/css" href="css/style.css" media="all">
	<link rel="stylesheet" href="css/jquery-ui.css" type="text/css" media="all" />
	<script src="js/jquery.min.js" type="text/javascript"></script>
	<script src="js/jquery-ui.min.js" type="text/javascript"></script>
	<script type='text/javascript' src='js/gen_validatorv31.js'></script>
	<script type="text/javascript" src="js/common.js"></script>
	<link rel="stylesheet" type="text/css" href="css/view.css" media="all">
	<link href="css/layout.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="js/view.js"></script>
	<script type="text/javascript" src="js/calendar.js"></script>
	<meta charset="utf-8">
	<!-- For Date picker only -->
	<script>
	  $(document).ready(function() {
	    $("#datepicker1").datepicker();
		$("#datepicker2").datepicker();
	  });
	</script>
	<!-- For Date picker only -->
	</head>
	<body>
<div class="wrapper"> 
      <!-- header -->
      <div class="c12 header">
    <div class="c8"> </div>
    <div class="c4">
          <h3>ASD Device details</h3>
        </div>
  </div>
      <!-- header ends -->
      <div class="clear">&nbsp;</div>
      <div class="demo"> 
    <!-- Inside header -->
    <div id="header"  class="row note">
          <div class="c8">
        <form id="labSearch" class="vform" method="post" action="labasd.php">
              <div class="c4">
            <label>Serial No (Auto Generating):</label>
          </div>
              <div class="c6">
            <input type="text" id="search_id" name="search_id" value="<?php echo $_REQUEST['search_id']; ?>">
          </div>
            </form>
      </div>
          <div class="c4">
        <ul class="quickLinks">
              <li>
            <p><a href="welcome.php">Home</a></p>
          </li>
              <li>
            <p>Welcome <span><?php echo $_SESSION['username']; ?></span></p>
          </li>
              <li>
            <p><a href="logout.php">Logout</a></p>
          </li>
            </ul>
      </div>
        </div>
    <!-- Inside header ends -->
    <div class="clear">&nbsp;</div>
    <div id="tabs">
          <ul>
        <li><a href="#tabs-1">Demographics</a></li>
        <li><a href="#tabs-2">Procedure</a></li>
        <li><a href="#tabs-3">Hemodynamics</a></li>
        <li><a href="#tabs-4">Complications</a></li>
        <li><a href="#tabs-5">Post Deployment Echo</a></li>
        <li><a href="#tabs-6">Pre Discharge Echo</a></li>
        <li><a href="#tabs-7">Follow up (3M)</a></li>
        <li><a href="#tabs-8">Follow up (1Y)</a></li>
      </ul>
          <div id="form_container">
          <!-- modified by MHA -->
          <div id="statusMsg" class="statusContainer row c12"> <span class='successMsg'><?php echo $successMsg; ?></span> <span class='errorMsg'><?php echo $validation_errors; ?></span> </div>
          <form id="labform1" class="hform" method="post" action="labasd.php">
        <input type="hidden" id="search_id" name="search_id" value="<?php echo $_REQUEST['search_id']; ?>">
        <div id="tabs-1" class="row">
            <div class="col2 c6">
				<div class="c12"><h6 class="blue">Demographics</h6></div>
                <div class="c12"><label for="fullname">Name / Initials </label>
					<input id="fullname" name="fullname" type="text" maxlength="255" value="<?php echo $fullname; ?>"/>
					<span id="labform1_fullname_errorloc" class="alert error" style="display:none"></span>
				</div>
				<div class="c12">
					<label for="gender">Gender </label>
					<select id="gender" name="gender">
                      <option value="" ></option>
                      <option value="1" <?php if($gender==1) echo 'selected="selected"'; ?>>Male</option>
                      <option value="2" <?php if($gender==2) echo 'selected="selected"'; ?>>Female</option>
					</select>
                <span id="labform1_gender_errorloc" class="alert error" style="display:none"></span>
                </div>
                <div class="c12"><div class="c5 pl0"><label for="dob_1">Date of Birth </label></div>
                  <?php 
											if($dob_1 && $dob_1!=='0000-00-00'){
												$str = explode('-',$dob_1);
												$dob_1_3 = $str[0];
												$dob_1_1 = $str[1];
												$dob_1_2 = $str[2];
											}											
										?>
										
                    <div class="c2 pr0 pl0">
                    <input id="dob_1_3" name="dob_1_3" class="post w58" size="4" maxlength="4" value="<?php echo $dob_1_3; ?>" type="text">
                    <span class="post" for="dob_1_3">YY</span>
                    </div> <div class="c2 pr0">
                    <input id="dob_1_1" name="dob_1_1" class="post" size="2" maxlength="2" value="<?php echo $dob_1_1; ?>" type="text">
                    <span class="post" for="dob_1_1">MM</span>
                    </div> <div class="c2 pr0">
                    <input id="dob_1_2" name="dob_1_2" class="post" size="2" maxlength="2" value="<?php echo $dob_1_2; ?>" type="text">
                    <span class="post" for="dob_1_2">DD</span>
                    </div> <span class="c1" id="calendar_2"> <img id="cal_img_2" class="datepicker" src="images/calendar.png" alt="Pick a date." onClick="calcAge()"> </span> 
                <script type="text/javascript">
												Calendar.setup({
												inputField	 : "dob_1_3",
												baseField    : "dob_1",
												displayArea  : "calendar_2",
												button		 : "cal_img_2",
												ifFormat	 : "%B %e, %Y",
												onSelect	 : selectDate
												});
											</script></div>
             

                <div class="c12"><div class="c5 pl0"><label class="w100" for="dop_1">Date of Procedure </label></div>
                <?php 
											if($dop_1 && $dop_1!=='0000-00-00'){
												$str = explode('-',$dop_1);
												$dop_1_3 = $str[0];
												$dop_1_1 = $str[1];
												$dop_1_2 = $str[2];
											}											
										?>
                  <div class="c2 pr0 pl0">
                    <input id="dop_1_3" name="dop_1_3" class="post w58" size="4" maxlength="4" value="<?php echo $dop_1_3; ?>" type="text">
                    <span class="post" for="dop_1_3">YY</span>
                    </div> <div class="c2 pr0">
                    <input id="dop_1_1" name="dop_1_1" class="post" size="2" maxlength="2" value="<?php echo $dop_1_1; ?>" type="text">
                    <span class="post" for="dop_1_1">MM</span>
                    </div> <div class="c2 pr0">
                    <input id="dop_1_2" name="dop_1_2" class="post" size="2" maxlength="2" value="<?php echo $dop_1_2; ?>" type="text">
                    <span class="post" for="dop_1_2">DD</span>
                    </div> <span class="c1" id="calendar_3"> <img id="cal_img_3" class="datepicker" src="images/calendar.png" alt="Pick a date."> </span> 
                <script type="text/javascript">
												Calendar.setup({
												inputField	 : "dop_1_3",
												baseField    : "dop_1",
												displayArea  : "calendar_3",
												button		 : "cal_img_3",
												ifFormat	 : "%B %e, %Y",
												onSelect	 : selectDate
												});
											</script></div>
               

                  <div class="row c12"><div class="c5 pl0"><label class="w100" for="agedoe">Age as on date of entry </label>
                  <?php 
											if($agedoe){
												$str = explode('-',$agedoe);
												$agedoey = $str[0];
												$agedoem = $str[1];
												$agedoed = $str[2];
											}											
										?>
                  </div>
                  <div class="c2  pr0 pl0">
					<span>
                    <input id="agedoey" name="agedoey" class="post w58" size="2" maxlength="2" value="<?php echo $agedoey; ?>" type="text">
                    <span class="post" for="agedoey">YY</span>
                    </span>
					</div>
					<div class="c2 pr0">
					<span>
                    <input id="agedoem" name="agedoem" class="post" size="2" maxlength="2" value="<?php echo $agedoem; ?>" type="text">
                    <span class="post" for="agedoem">MM</span>
                    </span>
					</div>
					<div class="c2 pr0">
					<span>
                    <input id="agedoed" name="agedoed" class="post" size="2" maxlength="4" value="<?php echo $agedoed; ?>" type="text">
                    <span class="post" for="agedoed">DD</span>
                    </span></div>
</div>

                  <div class="c4 pl0"><label class="w100" for="clindiagnosis">Clinical Diagnosis </label>
                  </div><div class="c8 pr0">
                      <textarea id="clindiagnosis" class="w91 ml9" name="clindiagnosis" ><?php echo $clindiagnosis; ?></textarea>
                    </div>
              </div>
              <div class="col2 c6">
				<div class="c12"><h6 class="blue">Patient Characteristic</h6></div>	

                <div class="c4 pl0"><label class="w100" for="sg">Somatic Growth - </label></div>
                <div class="c8">
                      <div class="12"><label  for="sgweight">Weight </label>
                      <input id="sgweight" name="sgweight" type="text" maxlength="255" value="<?php if($sgweight!=='0') echo $sgweight; ?>" onKeyUp="calcBSA()"/></div>
                      <div class="12"><label for="element_8">Height </label>
                      <input id="sgheight" name="sgheight" type="text" maxlength="255" value="<?php  if($sgheight!=='0') echo $sgheight; ?>" onKeyUp="calcBSA()"/></div>
                      <div class="12"><label for="sgbsa">BSA: </label>
                      <input id="sgbsa" name="sgbsa" type="text" maxlength="255" value="<?php if($sgbsa!=='0.0000') echo $sgbsa; ?>" readonly/></div>
                      <div class="12"><label  for="sgweightcen">Weight Centile </label>                      
                      <select  id="sgweightcen" name="sgweightcen">
                            <option value="" selected="selected"></option>
                            <?php
																	
																	foreach($labConfig['tab1']['sgweightcen'] as $key => $value) {
																		if($sgweightcen==$key)
																			echo "<option value=". $key ." selected='selected'>". $value ."</option>";
																		else
																			echo "<option value=". $key .">". $value ."</option>";
																	}													
																?>
                          </select>
						  </div>
					<div class="12">
						<label for="sgheightcen">Height Centile </label>
                          <select  id="sgheightcen" name="sgheightcen">
                            <option value="" selected="selected"></option>
                            <?php
																	
																	foreach($labConfig['tab1']['sgheightcen'] as $key => $value) {
																		if($sgheightcen==$key)
																			echo "<option value=". $key ." selected='selected'>". $value ."</option>";
																		else
																			echo "<option value=". $key .">". $value ."</option>";
																	}													
																?>
                          </select>
                        </div>
                        </div>
				
                <div class="c12"><label for="anesthesia">Anaesthesia </label>
             
                    <select id="anesthesia" name="anesthesia">
                      <option value="" selected="selected"></option>
                      <?php
														
														foreach($labConfig['tab1']['anesthesia'] as $key => $value) {
															?>
                      <option value="<?php echo $key; ?>" <?php if($anesthesia==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                      <?php
														}													
													?>
                    </select>
                  </div>
		
              <div class="c12"><label for="gas">GAS </label>
                    <select id="gas" name="gas">
                      <option value="" selected="selected"></option>
                      <?php
														
														foreach($labConfig['tab1']['gas'] as $key => $value) {
															?>
                      <option value="<?php echo $key; ?>" <?php if($gas==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                      <?php
														}													
													?>
                    </select>
                  </div>
          <div class="c12"><label for="prmedication">Prior Medication </label>
                    <select onChange="displayIfYes(this, 'detMedi');" id="prmedication" name="prmedication">
                      <option value="" selected="selected"></option>
                      <?php
														
														foreach($labConfig['tab1']['priorMedication'] as $key => $value) {?>
                      <option value="<?php echo $key; ?>" <?php if($prmedication==$key) echo 'selected="selected"';?>> <?php echo $value; ?> </option>
                      <?php
														}													
													?>
                    </select>
                  </div>
				  <div id="detMedi" class="c12" style="display:<?php if($prmedication=='1') echo 'block'; else echo 'none'; ?>">
                    <div class="">
                      <label  for="domedicine">Details of Medicine </label>
                    </div>
                    <div class="">
                      <textarea id="domedicine" name="domedicine"><?php echo $domedicine; ?></textarea>
                    </div>
                  </div>                  
          </div>
          <div class="c12">
                <label  for="comment1">Comment </label>
                <textarea class="w91" id="comment1" name="comment1"><?php echo $comment; ?></textarea>                   
          </div>
        
        <script type='text/javascript'>
				// <![CDATA[
				
				    var frmvalidator  = new Validator("labform1");
				    frmvalidator.EnableOnPageErrorDisplay();
				    frmvalidator.EnableMsgsTogether();
				    frmvalidator.addValidation("fullname","req","Please provide your name");				
				    frmvalidator.addValidation("gender","req","Please select your gender");
				
				    
				// ]]>
				</script>
        </div>
        <div id="tabs-2" class="row">
              <?php
				$tableName = 'labasd_procedure';
				if($_REQUEST['search_id'] && checkUserHasPermission('labasd_demographics', $_REQUEST['search_id']) && checkTableRowExists($tableName, $_REQUEST['search_id'])){						 
					$result = getTableDataQuery($tableName, $_REQUEST['search_id']);
					if(mysql_num_rows($result)>0){ 
						$row1 = mysql_fetch_assoc($result);								
						foreach($row1 as $key=>$val){
							${$key} = $val;
						}
					} 
				}?>
				
				  <!-- tab 2 column 1-->
          <div class="col2 c12 pl10">
				  <div class="c10">
                    <div class="c6 mTop15">
					<label for="tee">Trans Oesophageal Echo</label>
					<select id="tee" name="tee">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['tee'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($tee==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
					</div>
                    <div class="c6 mTop15">
					<label for="probe">Probe </label>
					  <select id="probe" name="probe">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['probe'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($probe==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
						</div>
                      <div class="c12 blockTitle"><label class="headTitle mb0" for="">ASD Measurement: </label></div>
                      <div class="c4"><label  for="asdm_tte">TTE</label>
                      <input id="asdm_tte" name="asdm_tte" class="post w30" size="4" maxlength="4" value="<?php echo $asdm_tte; ?>" type="text">
                          <span class="post">(mm)</span></div>
                      <div class="c4"><label  for="asdm_tee">TEE</label>
                      <input id="asdm_tee" name="asdm_tee" class="post w30" size="4" maxlength="4" value="<?php echo $asdm_tee; ?>" type="text">
                          <span class="post">(mm)</span></div>
                      <div class="c4"><label  for="asdm_bsd">Balloon Stretch Diameter</label>
                      <input id="asdm_bsd" name="asdm_bsd" class="post w30" size="4" maxlength="4" value="<?php echo $asdm_bsd; ?>" type="text">
                          <span class="post">(mm)</span></div>
					<div class="c12">	  
                   <div class="c4 pl0"><label  for="">No. of Defects </label>
                      <select onChange="displayIfMultiple(this)"  id="asdm_number" name="asdm_number">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['asdm_number'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($asdm_number==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
                      <div class="c8">
					  <div class="c12" id="ifmultiple" style="display:<?php if($asdm_number=='2') echo 'block'; else echo 'none'; ?>">
                          <div class="c6">
                          <label for="">If Multiple </label>
                        
                          <select onChange="displayIfMultipleSize(this)"  id="asdm_multiple" name="asdm_multiple">
                              <option value="" selected="selected"></option>
                              <?php
															
															foreach($labConfig['tab2']['asdm_multiple'] as $key => $value) {
																?>
                              <option value="<?php echo $key; ?>" <?php if($asdm_multiple==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                              <?php
															}													
														?>
                            </select>
                        </div>
                          <div class="c6" id="ifmultiplesize" style="display:<?php if($asdm_multiple=='2') echo 'block'; else echo 'none'; ?>">
                          
                              <label  for="">Additional Defect Size </label>
                         
                              <input id="asdm_size" name="asdm_size"  size="4" maxlength="4" value="<?php echo $asdm_size; ?>" type="text">
                       
                        </div>
                        </div></div></div>
                    
                      <div class="c12 blockTitle"><label class="mb0 headTitle" for="">Margin Measurement (mm): </label></div>
                    <div class="c12">
                      <div class="c1 pl0"><label class="w100"  for="">SVC </label></div>
                      <div class="c3"><select class="w100" id="m_svc" name="m_svc">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['m_svc'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($m_svc==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div><div class="c2">
                      <input id="m_svc_2" name="m_svc_2" class="w100" size="4" maxlength="4" value="<?php echo $m_svc_2; ?>" type="text"></div>
                      <div class="c1"><label class="w100" for="">IVC </label></div><div class="c3">
                      <select class="w100" id="m_ivc" name="m_ivc">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['m_svc'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($m_ivc==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div><div class="c2">
                      <input class="w100" id="m_ivc_2" name="m_ivc_2"  size="4" maxlength="4" value="<?php echo $m_ivc_2; ?>" type="text"></div></div>
                      <div class="c12"><div class="c1 pl0"><label class="w100" for="">Aortic </label></div>
                      <div class="c3"><select class="w100"  id="m_aortic" name="m_aortic">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['m_svc'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($m_aortic==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div><div class="c2">
                      <input id="m_aortic_2" name="m_aortic_2" class="w100" size="4" maxlength="4" value="<?php echo $m_aortic_2; ?>" type="text"></div>
                      <div class="c1"><label class="w100" for="">Mitral </label></div>
                      <div class="c3"><select class="w100" id="m_mitral" name="m_mitral">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['m_svc'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($m_mitral==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div><div class="c2">
                      <input id="m_mitral_2" class="w100" name="m_mitral_2"  size="4" maxlength="4" value="<?php echo $m_mitral_2; ?>" type="text"></div></div>
          
                      <div class="c12"><div class="c1 pl0"><label class="w100"  for="m_posterior">Posterior </label></div>
                      <div class="c3"><select  class="w100" id="m_posterior" name="m_posterior">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['m_svc'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($m_posterior==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div><div class="c2">
                      <input id="m_posterior_2" class="w100" name="m_posterior_2"  size="4" maxlength="4" value="<?php echo $m_posterior_2; ?>" type="text"></div></div>
                   
                      <div class="c12 blockTitle"><label class="mb0 headTitle" for="">Additional Cardiac Lesion </label></div>
                      <div class="c12"><div class="c6 row"><label for="acl_mr">MR </label>
                      <select onChange="displayIfYes(this, 'ifmryes')"  id="acl_mr" name="acl_mr">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['tee'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($acl_mr==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
                      <div id="ifmryes" class="c6" style="display:<?php if($acl_mr=='1') echo 'block'; else echo 'none'; ?>">
                        <label  for="acl_grade">Grade </label>
                        <select id="acl_grade" name="acl_grade">
                              <option value="" selected="selected"></option>
                              <?php
															
															foreach($labConfig['tab2']['acl_grade'] as $key => $value) {
																?>
                              <option value="<?php echo $key; ?>" <?php if($acl_grade==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                              <?php
															}													
														?>
                            </select>
                        
                        </div></div>
						<div class="c12">
                      <div class="c6"><label  for="acl_ps">PS </label>
                      <select onChange="displayIfYes(this, 'cathgrad')"  id="acl_ps" name="acl_ps">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['tee'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($acl_ps==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
						<div class="c6" id="cathgrad" style="display:<?php if($acl_ps=='1') echo 'block'; else echo 'none'; ?>">
                          <label  for="acl_cgradient">Cath Gradient </label>
                
                          <input class="post w35" id="acl_cgradient" name="acl_cgradient"  type="text" maxlength="255" value="<?php echo $acl_cgradient; ?>"/>
                          <span class="post" >(mm/Hg)</span>
                    
                        </div></div>
						<div class="c12">
                      <div class="c6"><label  for="acl_papvc">PAPVC </label>
                      <select onChange="displayIfYes(this, 'aclDesc')"  id="acl_papvc" name="acl_papvc">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['tee'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($acl_papvc==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
						<div class="c6" id="aclDesc" style="display:<?php if($acl_papvc=='1') echo 'block'; else echo 'none'; ?>">
                          
                          <label  for="acl_desc">Description </label>
                      
                          <input id="acl_desc" name="acl_desc"  type="text" maxlength="255" value="<?php echo $acl_desc; ?>"/>
                        </div>
                        </div>
						<div class="c12">
                      <div class="c6"><label  for="acl_others">Other Shunt: </label>
                      <select onChange="displayIfYes(this, 'aclSpec');"  id="acl_others" name="acl_others">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['tee'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($acl_others==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
                      <div class="c6" id="aclSpec" style="display:<?php if($acl_others=='1') echo 'block'; else echo 'none'; ?>">
                        
                          <label  for="acl_spec">Specify: </label>
                                            
                          <input id="acl_spec" name="acl_spec"  type="text" maxlength="255" value="<?php echo $acl_spec; ?>"/>
                        
                        </div>
                        </div>
                  
                      <div class="c12 blockTitle"><label class="mb0 headTitle"  for="">Procedural Details </label></div>
                      <div class="c6"><label  for="cd_access">Venous Access: </label>
                      <select onChange="displayIfYes(this, 'cdSide');"  id="cd_access" name="cd_access">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['cd_access'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($cd_access==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
                      <div class="c6" id="cdSide" style="display:<?php if($cd_access=='1') echo 'block'; else echo 'none'; ?>">
                         
                          <label  for="cd_side">Side: </label>
                       
                          
                          <select  id="cd_side" name="cd_side">
                              <option value="" selected="selected"></option>
                              <?php
															
															foreach($labConfig['tab2']['cd_side'] as $key => $value) {
																?>
                              <option value="<?php echo $key; ?>" <?php if($cd_side==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                              <?php
															}													
														?>
                            </select>
                        
                        </div>
                      <div class="c12 row">
                      <div class="c6"><label  for="cd_artaccess">Arterial Access: </label>
                      <select  id="cd_artaccess" name="cd_artaccess">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['cd_artaccess'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($cd_artaccess==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
						</div>
						</div>
                      <div class="c6"><label  for="">Balloon Sizing: </label>
                      <select onChange="displayIfYes(this, 'wsize');"  id="cd_bsize" name="cd_bsize">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['tee'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($cd_bsize==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
                      <div class="c6" id="wsize" style="display:<?php if($cd_bsize=='1') echo 'block'; else echo 'none'; ?>">
                        
                          <label  for="cd_wsize">Waist Size: </label>
                       
                          <input id="cd_wsize" name="cd_wsize"  type="text" maxlength="255" value="<?php echo $cd_wsize; ?>"/>
                          <label >(mm)</label>
                        </div>
                        <div class="c12 row">
                      <div class="c6"><label  for="cd_bsizetype">Type of Balloon Sizing: </label>
                      <select  id="cd_bsizetype" name="cd_bsizetype">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['cd_bsizetype'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($cd_bsizetype==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
                      </div>
					  <div class="c12 row">
					  <div class="c6">
					  <label  for="cd_sheathsize">Sheath Size: </label>
					  <select  id="cd_sheathsize" name="cd_sheathsize">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['cd_sheathsize'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($cd_sheathsize==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div></div>
                      <div class="c6"><label  for="cd_sheathtype">Sheath Type: </label>
                      <select onChange="displaySheatDevTypeOthr(this, 'cdSheathtypeOther');"  id="cd_sheathtype" name="cd_sheathtype">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['cd_sheathtype'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($cd_sheathtype==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
                     <div class="c6" id="cdSheathtypeOther" style="display:<?php if($cd_sheathtype=='8') echo 'block'; else echo 'none'; ?>">
                          
                          <label  for="cd_sheathtype_other">Specify: </label>
                        
                          <input id="cd_sheathtype_other" name="cd_sheathtype_other"  type="text" maxlength="255" value="<?php echo $cd_sheathtype_other; ?>"/>
                        
                        </div>
					</div>
					<!--- tab2 column1 ends-->
					<!--- tab2 column2-->
				  <div class="c10">
				  <div class="c12 mTop15"><label  for="cd_fdevicesize">Final Device Size: </label><input id="cd_fdevicesize" name="cd_fdevicesize"  type="text" maxlength="255" value="<?php echo $cd_fdevicesize; ?>"/></div>
				  <div class="c12"><div class="">
				  <label  for="cd_devicetype">Device Make: </label>
				  <select onChange="displaySheatDevTypeOthr(this, 'cdDevicetypeOther');"  id="cd_devicetype" name="cd_devicetype">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['cd_sheathtype'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($cd_devicetype==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
                      <div class="" id="cdDevicetypeOther" style="display:<?php if($cd_devicetype=='8') echo 'block'; else echo 'none'; ?>">
                          <div>
                          <label  for="cd_devicetype_other">Specify: </label>
                        </div>
                          <div>
                          <input id="cd_devicetype_other" name="cd_devicetype_other"  type="text" maxlength="255" value="<?php echo $cd_devicetype_other; ?>"/>
                        </div>
                        </div></div>
                    <div class="c12"><label  for="cd_devicemodel">Device Model: </label> <input id="cd_devicemodel" name="cd_devicemodel" type="text" maxlength="255" value="<?php echo $cd_devicemodel; ?>"/></div>
                    <div class="c12"><label  for="cd_deviceno">No. of Devices: </label>
					<select  id="cd_deviceno" name="cd_deviceno">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['cd_deviceno'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($cd_deviceno==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
                      <div class="c12"><label  for="cd_approach">Approach: </label> <select  id="cd_approach" name="cd_approach">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['cd_approach'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($cd_approach==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
						<div class="c12"><label  for="deploy_technique">Deployment Technique: </label><select  id="deploy_technique" name="deploy_technique">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['deploy_technique'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($deploy_technique==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
						<div class="c12">
                      <div class="c3"><label class="w100"  for="result">Result </label></div>
                      <div class="c3"><label class="w100"  for="upsize">Upsize </label></div>
                      <div class="c3"><label class="w100"  for="downsize">Down Size </label></div>
                      <div class="c3"><label class="w100"  for="abandoned">Abandoned</label></div>
                    </div>
                      <div class="c12">
					  <div class="c3 pl0"><select class="w100"  id="result" name="result">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['result'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($result==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
                      <div class="c3"><input class="w100"  id="upsize" name="upsize"  type="text" maxlength="255" value="<?php echo $upsize; ?>"/></div>
                      <div class="c3"><input class="w100"  id="downsize" name="downsize"  type="text" maxlength="255" value="<?php echo $downsize; ?>"/></div>
                      <div class="c3"><input class="w100"  id="abandoned" name="abandoned"  type="text" maxlength="255" value="<?php echo $abandoned; ?>"/></div>
                    </div>
                     
                      <div class="c12"><label  for="noofattempts">Number of Attempts at deployment: </label>
					  <input id="noofattempts" name="noofattempts"  type="text" maxlength="255" value="<?php echo $noofattempts; ?>"/></td> </div>
                      <div class="c12"><label  for="badeploy">Balloon Assisted Deployment: </label>
                      <select  id="badeploy" name="badeploy">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['tee'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($badeploy==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
                      <div class="c12"><label  for="change_devicesize">Need to change Device size: </label>
					  <select  id="change_devicesize" name="change_devicesize" onChange="displayIfYes(this, 'devicesize')">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['tee'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($change_devicesize==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
                      <div id="devicesize" class="c12" style="display:<?php if($change_devicesize=='1') echo 'block'; else echo 'none'; ?>">
                      <label  for="ifyes">if yes: </label>
					  <select  id="ifyes" name="ifyes">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['ifyes'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($ifyes==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
                     <div class="c12"><label  for="addproc">Additional Procedure: </label>
					 <select onChange="displayIfYes(this, 'addprocOther');"  id="addproc" name="addproc">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab2']['tee'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($addproc==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
						<div id="addprocOther" style="display:<?php if($addproc=='1') echo 'block'; else echo 'none'; ?>">
                          <div>
                          <label  for="addproc_other">Specify: </label>
                        </div>
                          <div>
                          <input id="addproc_other" name="addproc_other"  type="text" maxlength="255" value="<?php echo $addproc_other; ?>"/>
                        </div>
                        </div></div>
                    <div class="c12"><label  for="flurotime">Fluoroscopic Time (min): </label> <input id="flurotime" name="flurotime"  type="text" maxlength="255" value="<?php echo $flurotime; ?>"/></div>
                      <div class="c12"><label  for="proctime">Procedure Time (min): </label> <input id="proctime" name="proctime"  type="text" maxlength="255" value="<?php echo $proctime; ?>"/></div>
					<!--- tab2 column2 end-->
					</div>
					 <div class="c12">
	                	<label  for="comment1">Comment </label>
	                	<textarea class="w91" id="comment2" name="comment2"><?php echo $comment; ?></textarea>                   
	          		</div>
		    </div>
        </div>
        <div id="tabs-3" class="row">
		
              <?php 
				$tableName = 'labasd_hemodynamic_cond';
				if($_REQUEST['search_id'] && checkUserHasPermission('labasd_demographics', $_REQUEST['search_id']) && checkTableRowExists($tableName, $_REQUEST['search_id'])){						 
				    $type = 'condition1_2';
					$result = getTableDataQueryHemo($tableName, $_REQUEST['search_id'], $type);
					if(mysql_num_rows($result)>0){ 
						$row1 = mysql_fetch_assoc($result);	
						$type1_id = 	$row1['id'];					
						$cond1_text= $row1['condText1'];	
						$cond1_other= $row1['cond1_other'];
						$cond2_text= $row1['condText2'];
						$cond2_other= $row1['cond2_other'];
						$oxygen_consumption = $row1['oxygen_consumption'];	
						$comment = $row1['comment'];
						
					}
					$type = 'condition3_4';
					$result = getTableDataQueryHemo($tableName, $_REQUEST['search_id'], $type);
					if(mysql_num_rows($result)>0){ 
						$row1 = mysql_fetch_assoc($result);						
						$type2_id = 	$row1['id'];
						$cond3_text= $row1['condText1'];
						$cond3_other= $row1['cond1_other'];
						$cond4_text= $row1['condText2'];
						$cond4_other= $row1['cond2_other'];
						$oxygen_consumption = $row1['oxygen_consumption'];	
						$comment = $row1['comment'];
						
					}
					
				}				 
					
				?>
				<!--- tab2 column2 end-->
              <div>
            <!--Hemodynamics Data table-->
            <div class="c12">
                  <h6 class="blue">Hemodynamics Data</h6>
                </div>
            <div class="c12 block">
            <div class="c12 dynaTitle">
                      <div class="c2 plo"><label class="w100 mt5 mb0" for="condition1_2">Condition 1 and 2</label></div>
					  <div class="c5">
					  <div class="c6">
					  <label class="mt5" for="condition1">Condition 1</label>
                      <select id="condition1" class="mb0" name="condition1" onChange="displayConditionOthr(this,'cond1Othr')">
                          <option value="" selected="selected"></option>
                          <?php foreach($labConfig['tab3']['condition1'] as $key => $value) { ?>
                          <option value="<?php echo $key; ?>" <?php if($cond1_text==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php } ?>
                      </select>  </div>
                      <div id="cond1Othr" class="c6" style="display:<?php if($cond1_text=='4') echo 'block'; else echo 'none'; ?>">
                      <label class="mt5 mb0" for="cond1Othr">Others</label>
                      <input class="mb0" id="cond1_other" name="cond1_other"  type="text" maxlength="255" value="<?php echo $cond1_other; ?>" >
                      </div>
                      </div>
					  <div class="c5">
					  <div class="c6">
					  
                      <label class="mt5 mb0" for="">Condition 2</label>
                      <select id="condition2" class="mb0" name="condition2" onChange="displayConditionOthr(this,'cond2Othr')">
                          <option value="" selected="selected"></option>
                          <?php foreach($labConfig['tab3']['condition2'] as $key => $value) { ?>
                          <option value="<?php echo $key; ?>" <?php if($cond2_text==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php } ?>
                      </select></div>
                      <div id="cond2Othr" class="c6" style="display:<?php if($cond2_text=='4') echo 'block'; else echo 'none'; ?>">
                      <label class="mt5 mb0" for="cond2Othr">Others</label>
                      <input class="mb0" id="cond2_other" name="cond2_other"  type="text" maxlength="255" value="<?php echo $cond2_other; ?>" >
                      </div>
                      </div>
                </div>
            
			<!--Conditional Table 1 and 2-->
            <div class="c12 row">
                      <div class="c6">
                      <div class="c12">
					  <label class="mt5" id="label1" for="condition1"><b>Condition 1</b></label>
					  </div>
					  <div class="c12">
					  <table id="conditionTab1">
                        <tr>
                          <th><label class="w100 mb0" for="chamber">Chamber</label></th>
                          <th><label class="w100 mb0" for="cond1_sys1">Sys (v)</label></th>
                          <th><label class="w100 mb0" for="cond1_dia1">Dia (a)</label></th>
                          <th><label class="w100 mb0" for="cond1_mean1">Mean</label></th>
                          <th><label class="w100 mb0" for="cond1_021">O2 Sat%</label></th>
                          <th>&nbsp;</th>
                        </tr>
                          <?php
								if($_REQUEST['search_id'] && checkUserHasPermission('labasd_demographics', $_REQUEST['search_id']) && checkTableRowExists($tableName, $_REQUEST['search_id'])){								
									$tableName1 = 'labasd_hemodynamic_cond_data';
									$resCond = getTableDataQueryParent($tableName1, $type1_id);
									
									$cnt = 1;
									if(mysql_num_rows($resCond)>0){
										while($row1 = mysql_fetch_assoc($resCond)){
											?>
                          <tr>
                          <td class="vAT"><select class="mb0 w100" onChange="displayHideSysDia(this, 'cond1', '<?php echo $cnt; ?>');"  id="chamber<?php echo $cnt; ?>" name="cond[<?php echo $cnt; ?>][chamber]">
                              <option value=""></option>
                              <?php
												foreach($labConfig['tab3']['chamber'] as $key => $value) {
													if($row1['chamber']==$key)
														echo "<option value=". $key ." selected='selected'>". $value ."</option>";
													else
														echo "<option value=". $key .">". $value ."</option>";
												}
												?>
                            </select></td>
                          <td>
                          	<?php 
                          		  $chamberVals = array('12','3','9','10','11','13','14'); 
                          		  $dispVal = 'block';
                          		  $dispValDiv = 'none';
                          			
                          			if(in_array($row1['chamber'], $chamberVals)) {
                          				$dispVal = 'none'; 
                          				$dispValDiv = 'block';
                          			}
                          	?>
                          	
							  <div id="cond1_Sys<?php echo $cnt; ?>" style="display:<?php echo $dispVal; ?>">                              
                                <input class="w100 mb0" id="cond1_sys<?php echo $cnt; ?>" name="cond[<?php echo $cnt; ?>][sys]"  type="text" maxlength="255" value="<?php echo $row1['sys'];?>">
                              </div>
							  <div id="div_cond1_Sys<?php echo $cnt; ?>" style="display:<?php echo $dispValDiv; ?>">&nbsp;
							  </div>
						  </td>
						  <td>
                              <div id="cond1_Dia<?php echo $cnt; ?>" style="display:<?php echo $dispVal; ?>">
                                <input class="w100 mb0" id="cond1_dia<?php echo $cnt; ?>" name="cond[<?php echo $cnt; ?>][dia]"  type="text" maxlength="255" value="<?php echo $row1['dia'];?>">
                              </div>
                              <div id="div_cond1_Dia<?php echo $cnt; ?>" style="display:<?php echo $dispValDiv; ?>">&nbsp;
							  </div>
                          </td>
                          <td><input class="w100 mb0" id="cond1_mean<?php echo $cnt; ?>" name="cond[<?php echo $cnt; ?>][mean]"  type="text" maxlength="255" value="<?php echo $row1['mean'];?>"></td>
                          <td><input class="w100 mb0" id="cond1_t02<?php echo $cnt; ?>" name="cond[<?php echo $cnt; ?>][t02]"  type="text" maxlength="255" value="<?php echo $row1['t02'];?>" onKeyPress="return addRow(event,'conditionTab1');"></td>
                          <td class="vAT"><input class="button red mb0" type="button" id="del<?php echo $cnt; ?>" value="Delete" <?php if($cnt>1){ echo 'onclick="removeRow(this,\'conditionTab1\')"'; } ?>></td>
                        </tr>
                          <?php
											$cnt++;
										}
									}								
								}else{
								?>
                          <tr>
                          <td class="vAT"><select class="mb0 w100" onChange="displayHideSysDia(this, 'cond1', '1');" id="chamber1" name="cond[1][chamber]">
                              <option value=""></option>
                              <?php														
												foreach($labConfig['tab3']['chamber'] as $key => $value) {
													echo "<option value=". $key .">". $value ."</option>";
												}													
											?>
                            </select></td>
                          <td>
                              <div id="cond1_Sys1" style="display:block">
                                <input class="w100 mb0" id="cond1_sys1" name="cond[1][sys]"  type="text" maxlength="255" value="">
                              </div>
                              <div id="div_cond1_Sys1" style="display:none;">&nbsp;
							  </div>
						  </td>
						  <td>
                              <div id="cond1_Dia1" style="display:block">
                                <input class="w100 mb0" id="cond1_dia1" name="cond[1][dia]"  type="text" maxlength="255" value="">
                              </div>
                              <div id="div_cond1_Dia1" style="display:none;">&nbsp;
							  </div>
                         </td>
                          <td><input class="w100 mb0" id="cond1_mean1" name="cond[1][mean]"  type="text" maxlength="255" value=""></td>
                          <td><input class="w100 mb0" id="cond1_t02" name="cond[1][t02]"  type="text" maxlength="255" value="" onKeyPress="return addRow(event,'conditionTab1');"></td>
                          <td class="vAT"><input class="button red mb0" type="button" id="del1" value="Delete"></td>
                        </tr>
                          <?php } ?>
                        </table>
						</div>
						</div>
                      <div class="c6">
                      <div class="c12">
					  <label class="mt5" id="label2" for="condition2"><b>Condition 2</b></label></div>
                         <div class="c12">
						 
                        <table id="conditionTab2">
                          <tr>
                          <th>
                            <label class="w100 mb0" for="cond2_sys1">Sys (v)</label>
                          </th>
						  <th>
							<label class="w100 mb0" for="cond2_dia1">Dia (a)</label>
                          </th>
                          <th><label class="w100 mb0" for="cond2_mean1">Mean</label></th>
                          <th><label class="w100 mb0" for="cond2_021">O2 Sat%</label></th>
                          <th>&nbsp;</th>
                        </tr>
                          <?php
									if($_REQUEST['search_id'] && checkUserHasPermission('labasd_demographics', $_REQUEST['search_id']) && checkTableRowExists($tableName, $_REQUEST['search_id'])){								
										$tableName1 = 'labasd_hemodynamic_cond_data';
										$resCond = getTableDataQueryParent($tableName1, $type1_id);
										
										$cnt1 = 1;
										if(mysql_num_rows($resCond)>0){
											while($row1 = mysql_fetch_assoc($resCond)){
												?>
                          <tr>                          
                          <td>
                          	<div id="cond2_Sys<?php echo $cnt1; ?>" style="display:<?php echo $dispVal; ?>">
	                          <input class="w100 mb0" id="cond2_sys<?php echo $cnt1; ?>" name="cond[<?php echo $cnt1; ?>][sys_2]"  type="text" maxlength="255" value="<?php echo $row1['sys_2'];?>">
							</div>
							<div id="div_cond2_Sys<?php echo $cnt1; ?>" style="display:<?php echo $dispValDiv; ?>">&nbsp;
							  </div>
	                      </td>
						  <td>
							<div id="cond2_Dia<?php echo $cnt1; ?>" style="display:<?php echo $dispVal; ?>">
							<input class="w100 mb0" id="cond2_dia<?php echo $cnt1; ?>" name="cond[<?php echo $cnt1; ?>][dia_2]"  type="text" maxlength="255" value="<?php echo $row1['dia_2'];?>">
							</div>
							<div id="div_cond2_Dia<?php echo $cnt1; ?>" style="display:<?php echo $dispValDiv; ?>">&nbsp;
							</div>                          	
                          </td>
                          <td><input class="w100 mb0" id="cond2_mean<?php echo $cnt1; ?>" name="cond[<?php echo $cnt1; ?>][mean_2]"  type="text" maxlength="255" value="<?php echo $row1['mean_2'];?>"></td>
                          <td><input class="w100 mb0" id="cond2_t02<?php echo $cnt1; ?>" name="cond[<?php echo $cnt1; ?>][t02_2]"  type="text" maxlength="255" value="<?php echo $row1['t02_2'];?>" onKeyPress="return addRow(event,'conditionTab2');"></td>
                          <td class="vAT"><input class="button red" type="button" id="del2" value="Delete" <?php if($cnt1>1){ echo 'onclick="removeRow(this,\'conditionTab2\')"'; } ?>></td>
                        </tr>
                          <?php
												$cnt1++;
											}				
										}				
									}else{
									?>
                          <tr>
                          <td>
							  <div id="cond2_Sys1" style="display:block;">	                          
							  <input class="w100 mb0" id="cond2_sys1" name="cond[1][sys_2]"  type="text" maxlength="255" value="">
							  </div>
							  <div id="div_cond2_Sys1" style="display:none;">&nbsp;
							  </div>
						  </td>
						  <td>
	                          <div id="cond2_Dia1" style="display:block;">	
							  <input class="w100 mb0" id="cond2_dia1" name="cond[1][dia_2]"  type="text" maxlength="255" value="">
							  </div>   
							  <div id="div_cond2_Dia1" style="display:none;">&nbsp;
							  </div>                       	
                          </td>
                          <td><input class="w100 mb0" id="cond2_mean1" name="cond[1][mean_2]"  type="text" maxlength="255" value=""></td>
                          <td><input class="w100 mb0" id="cond2_t021" name="cond[1][t02_2]"  type="text" maxlength="255" value="" onKeyPress="return addRow(event,'conditionTab2');"></td>
                          <td class="vAT"><input class="button red mb0" type="button" id="del2" value="Delete"></td>
                        </tr>
                          <?php } ?>
                        </table></div>
						</div>
                    
                </div>
            </div>
			<div class="clear">&nbsp;</div>
            <!--Conditional Table 3 and 4-->
            <div class="c2 centered first"><a class="button orange" href="#" onclick="hideShowCond3and4();">Add Condition 3 and 4</a></div>
            <div class="clear">&nbsp;</div>
            <div class="c12 row block" id="cond3and4" style="display:none;">
			<div class="c12 dynaTitle">
                      <div class="c2"><label class="w100 mt5" for="condition3_4">Condition 3 and 4</label></div>
                      <div class="c5"><div class="c6"><label class="mt5 mb0" for="condition3">Condition 3</label>
					  <select class="mb0" id="condition3" name="condition3" onChange="displayConditionOthr(this,'cond3Othr')">
                          <option value="" selected="selected"></option>
                          <?php foreach($labConfig['tab3']['condition2'] as $key => $value) { ?>
                          <option value="<?php echo $key; ?>" <?php if($cond3_text==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php } ?>
                      </select>
                      </div>
                      <div class="c6">
                      <div id="cond3Othr" style="display:<?php if($cond3_text=='4') echo 'block'; else echo 'none'; ?>">
                      <label class="mt5 mb0" for="cond3Othr">Others</label>
                      <input class="mb0" id="cond3_other" name="cond3_other"  type="text" maxlength="255" value="<?php echo $cond3_other; ?>" >
                      </div>
                      </div>
                      </div>                      
                      <div class="c5">
					  <div class="c6"><label class="mt5 mb0" for="condition4">Condition 4</label>
					  
                      <select id="condition4" class="mb0" name="condition4" onChange="displayConditionOthr(this,'cond4Othr')">
                          <option value="" selected="selected"></option>
                          <?php foreach($labConfig['tab3']['condition2'] as $key => $value) { ?>
                          <option value="<?php echo $key; ?>" <?php if($cond4_text==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php } ?>
                      </select>
                      </div>
                      <div class="c6">                      
                      <div id="cond4Othr" style="display:<?php if($cond3_text=='4') echo 'block'; else echo 'none'; ?>">
                      <label class="mt5 mb0" for="cond4Othr">Others</label>
                      <input class="mb0" id="cond4_other" name="cond4_other"  type="text" maxlength="255" value="<?php echo $cond4_other; ?>" >
                      </div>
                      </div>
                      </div>
                    </div>
                      <div class="c12">
					  <div class="c12"><div class="c6"><label class="mt5" id="label3" for="condition3"><b>Condition 3</b></label></div><div class="c6"><label class="mt5" id="label3" for="condition3"><b>Condition 4</b></label></div></div>
                      <div class="c6">
							
						<table id="conditionTab3">
                          <tr>
                          <th><label class="w100 mb0" for="chamber1">Chamber</label></th>
                          <th>
							<label class="w100 mb0" for="cond3_sys1">Sys (v)</label>
						  </th>
						  <th>
                          	<label class="w100 mb0" for="cond3_dia1">Dia (a)</label>                        	
                          </th>
                          <th><label class="w100 mb0" for="cond3_mean1">Mean</label></th>
                          <th><label class="w100 mb0" for="cond3_021">O2 Sat%</label></th>
                          <th>&nbsp;</th>
                        </tr>
                          <?php
								if($_REQUEST['search_id'] && checkUserHasPermission('labasd_demographics', $_REQUEST['search_id']) && checkTableRowExists($tableName, $_REQUEST['search_id'])){								
									$tableName1 = 'labasd_hemodynamic_cond_data';
									$resCond = getTableDataQueryParent($tableName1, $type2_id);
									
									$cnt = 1;
									if(mysql_num_rows($resCond)>0){
										while($row1 = mysql_fetch_assoc($resCond)){
											?>
                          <tr>
                          <td class="vAT"><select class="w100 mb0" onChange="displayHideSysDia(this, 'cond3', '<?php echo $cnt; ?>');" class="element select long" id="cond2_chamber<?php echo $cnt; ?>" name="cond2[<?php echo $cnt; ?>][chamber]">
                              <option value=""></option>
                              <?php
												foreach($labConfig['tab3']['chamber'] as $key => $value) {
													if($row1['chamber']==$key)
														echo "<option value=". $key ." selected='selected'>". $value ."</option>";
													else
														echo "<option value=". $key .">". $value ."</option>";
												}
												?>
                            </select></td>
                        
                          <td>  
							  <?php 
                          		  $chamberVals = array('12','3','9','10','11','13','14'); 
                          		  $dispVal3 = 'block';
                          		  $dispValDiv3 = 'none';
                          			
                          			if(in_array($row1['chamber'], $chamberVals)) {
                          				$dispVal3 = 'none'; 
                          				$dispValDiv3 = 'block';
                          			}
                          	  ?>
							  <div id="cond3_Sys<?php echo $cnt; ?>" style="display:<?php echo $dispVal3; ?>">
	                          <input class="w100 mb0" id="cond3_sys<?php echo $cnt; ?>" name="cond2[<?php echo $cnt; ?>][sys]" type="text" maxlength="255" value="<?php echo $row1['sys'];?>">
							  </div>
							  <div id="div_cond3_Sys<?php echo $cnt; ?>" style="display:<?php echo $dispValDiv3; ?>">&nbsp;
							  </div>
						  </td>
						  <td>
							  <div id="cond3_Dia<?php echo $cnt; ?>" style="display:<?php echo $dispVal3; ?>">
							  <input class="w100 mb0" id="cond3_dia<?php echo $cnt; ?>" name="cond2[<?php echo $cnt; ?>][dia]"  type="text" maxlength="255" value="<?php echo $row1['dia'];?>">
                          	  </div>
                          	  <div id="div_cond3_Dia<?php echo $cnt; ?>" style="display:<?php echo $dispValDiv3; ?>">&nbsp;
							  </div>
                          </td>
                          
                          <td><input class="w100 mb0" id="cond3_mean<?php echo $cnt; ?>" name="cond2[<?php echo $cnt; ?>][mean]"  type="text" maxlength="255" value="<?php echo $row1['mean'];?>"></td>
                          <td><input class="w100 mb0" id="cond3_t02<?php echo $cnt; ?>" name="cond2[<?php echo $cnt; ?>][t02]"  type="text" maxlength="255" value="<?php echo $row1['t02'];?>" onKeyPress="return addRow(event,'conditionTab3');"></td>
                          <td class="vAT"><input class="button red mb0" type="button" id="del<?php echo $cnt; ?>" value="Delete" <?php if($cnt>1){ echo 'onclick="removeRow(this,\'conditionTab3\')"'; } ?>></td>
                        </tr>
                          <?php
											$cnt++;
										}
									}								
								}else{
								?>
                          <tr>
                          <td class="vAT"><select onChange="displayHideSysDia(this, 'cond3', '1');" class="w100 mb0" id="cond2_chamber1" name="cond2[1][chamber]">
                              <option value=""></option>
                              <?php														
												foreach($labConfig['tab3']['chamber'] as $key => $value) {
													echo "<option value=". $key .">". $value ."</option>";
												}													
											?>
                            </select></td>
                          
                          <td>
							  <div id="cond3_Sys1" style="display:block;">
	                          <input class="w100 mb0" id="cond3_sys1" name="cond2[1][sys]"  type="text" maxlength="255" value="">
							  </div>
							  <div id="div_cond3_Sys1" style="display:none;">&nbsp;
							  </div>
						  </td>
						  <td>
	                          <div id="cond3_Dia1" style="display:block;">
							  <input class="w100 mb0" id="cond3_dia1" name="cond2[1][dia]"  type="text" maxlength="255" value="">
							  </div>    
							  <div id="div_cond3_Dia1" style="display:none;">&nbsp;
							  </div>                      
                          </td>                          
                          <td><input class="w100 mb0" id="cond3_mean1" name="cond2[1][mean]"  type="text" maxlength="255" value=""></td>
                          <td><input class="w100 mb0" id="cond3_t02" name="cond2[1][t02]"  type="text" maxlength="255" value="" onKeyPress="return addRow(event,'conditionTab3');"></td>
                          <td class="vAT"><input class="button red mb0" type="button" id="del1" value="Delete"></td>
                        </tr>
                          <?php } ?>
                        </table>
						</div>
                      <div class="c6">
					  <table id="conditionTab4">
                          <tr>
                          
                          <th>
							<label class="w100 mb0" for="cond4_sys1">Sys (v)</label>
						</th>
						<th>
							<label class="w100 mb0" for="cond4_dia1">Dia (a)</label>	                         
                        </th>
                          <th><label class="w100 mb0" for="cond4_mean1">Mean</label></th>
                          <th><label class="w100 mb0" for="cond4_021">O2 Sat%</label></th>
                          <th>&nbsp;</th>
                        </tr>
                          <?php
									if($_REQUEST['search_id'] && checkUserHasPermission('labasd_demographics', $_REQUEST['search_id']) && checkTableRowExists($tableName, $_REQUEST['search_id'])){								
										$tableName1 = 'labasd_hemodynamic_cond_data';
										$resCond = getTableDataQueryParent($tableName1, $type2_id);
										
										$cnt1 = 1;
										if(mysql_num_rows($resCond)>0){
											while($row1 = mysql_fetch_assoc($resCond)){
												?>
                          <tr>
                          <td> 
								  <div id="cond4_Sys<?php echo $cnt1; ?>" style="display:<?php echo $dispVal3; ?>">		                          
								  <input class="w100 mb0" id="cond4_sys<?php echo $cnt1; ?>" name="cond2[<?php echo $cnt1; ?>][sys_2]"  type="text" maxlength="255" value="<?php echo $row1['sys_2'];?>">
								  </div>
								  <div id="div_cond4_Sys<?php echo $cnt1; ?>" style="display:<?php echo $dispValDiv3; ?>">&nbsp;
							  	  </div>
					      </td>
						  <td>
		                          <div id="cond4_Dia<?php echo $cnt1; ?>" style="display:<?php echo $dispVal3; ?>">
								  <input class="w100 mb0" id="cond4_dia<?php echo $cnt1; ?>" name="cond2[<?php echo $cnt1; ?>][dia_2]"  type="text" maxlength="255" value="<?php echo $row1['dia_2'];?>">
								  </div>
								  <div id="div_cond4_Dia<?php echo $cnt1; ?>" style="display:<?php echo $dispValDiv3; ?>">&nbsp;
							  	  </div>	                          
                          </td>
                          
                          <td><input class="w100 mb0" id="cond4_mean<?php echo $cnt1; ?>" name="cond2[<?php echo $cnt1; ?>][mean_2]"  type="text" maxlength="255" value="<?php echo $row1['mean_2'];?>"></td>
                          <td><input class="w100 mb0" id="cond4_t02<?php echo $cnt1; ?>" name="cond2[<?php echo $cnt1; ?>][t02_2]"  type="text" maxlength="255" value="<?php echo $row1['t02_2'];?>" onKeyPress="return addRow(event,'conditionTab4');"></td>
                          <td class="vAT"><input type="button" id="del2" value="Delete" <?php if($cnt1>1){ echo 'onclick="removeRow(this,\'conditionTab4\')"'; } ?>></td>
                        </tr>
                          <?php
												$cnt1++;
											}				
										}				
									}else{
									?>
                          <tr>
                          <td>
                          	<div id="cond4_Sys1" style="display:block;">
	                         <input class="w100 mb0" id="cond4_sys1" name="cond2[1][sys_2]"  type="text" maxlength="255" value="">
							 </div>
							 <div id="div_cond4_Sys1" style="display:none;">&nbsp;
							 </div>
						  </td>
						  <td>
	                         <div id="cond4_Dia1" style="display:block;">
							 <input class="w100 mb0" id="cond4_dia1" name="cond2[1][dia_2]"  type="text" maxlength="255" value="">							 
							 </div>
							 <div id="div_cond4_Dia1" style="display:none;">&nbsp;
							 </div>
                          </td>
                          <td><input class="w100 mb0" id="cond4_mean1" name="cond2[1][mean_2]"  type="text" maxlength="255" value=""></td>
                          <td><input class="w100 mb0" id="cond4_t021" name="cond2[1][t02_2]"  type="text" maxlength="255" value="" onKeyPress="return addRow(event,'conditionTab4');"></td>
                          <td class="vAT"><input class="button red mb0" type="button" id="del2" value="Delete"></td>
                        </tr>
                          <?php } ?>
                        </table>
                    </div>
                  
                </div>
                </div>
            <div class="clear">&nbsp;</div>
            <!--Flow & Resisntane Calc Table-->
            <div>
                  <td width="100%" valign="top"> Flow and Resistance calculation </td>
                </div>
            <div>
				<table>
				<tr>
                  <td width="100%" valign="top">
				  <table id="calcTab">
                      <tr>
                      <td width="18%">Parameters</td>
                      <td width="20%">Condition 1</td>
                      <td width="20%">Condition 2</td>
                      <td width="20%">Condition 3</td>
                      <td width="20%">Condition 4</td>
                      <td width="2%"></td>
                    </tr>
                      <tr>
                      <td colspan="1">Oxygen Consumption (ml/min/m2)</td>
                      <td colspan="5"><input style="width:250px;" id="oxygen_consumption" name="oxygen_consumption"  type="text" maxlength="255" value="<?php echo $oxygen_consumption; ?>"></td>
                    </tr>
                    <tr>
                      <td colspan="1">Haemoglobin</td>
                      <td colspan="5"><input style="width:250px;" id="haemoglobin" name="haemoglobin"  type="text" maxlength="255" value="<?php echo $haemoglobin; ?>"></td>
                    </tr>
                    <tr>
                      <td colspan="1">Heart Rate</td>
                      <td colspan="5"><input style="width:250px;" id="heart_rate" name="heart_rate"  type="text" maxlength="255" value="<?php echo $heart_rate; ?>"></td>
                    </tr>
                      <?php								
								if($_REQUEST['search_id'] && checkUserHasPermission('labasd_demographics', $_REQUEST['search_id']) && checkTableRowExists($tableName, $_REQUEST['search_id'])){
									$tableName2 = 'labasd_hemodynamic_calc';
									$resCalc = getTableDataQueryParent($tableName2, $_REQUEST['search_id']);
									
									
									$cnt2 = 1;
									if(mysql_num_rows($resCalc)>0){
										while($row1 = mysql_fetch_assoc($resCalc)){
											?>
                      <tr>
                      <td width="18%"><select class="element select long" id="parameter<?php echo $cnt2; ?>" name="calc[<?php echo $cnt2; ?>][parameter]">
                          <option value=""></option>
                          <?php														
														foreach($labConfig['tab3']['parameter'] as $key => $value) {
															if($row1['parameter']==$key)
																echo "<option value=". $key ." selected='selected'>". $value ."</option>";
															else
																echo "<option value=". $key .">". $value ."</option>";
														}													
													?>
                        </select></td>
                      <td width="20%"><input style="width:120px;" id="flowresistance_condition1" name="calc[<?php echo $cnt2; ?>][flowresistance_condition1]"  type="text" maxlength="255" value="<?php echo $row1['flowresistance_condition1']; ?>"></td>
                      <td width="20%"><input style="width:120px;" id="flowresistance_condition2" name="calc[<?php echo $cnt2; ?>][flowresistance_condition2]"  type="text" maxlength="255" value="<?php echo $row1['flowresistance_condition2']; ?>"></td>
                      <td width="20%"><input style="width:120px;" id="flowresistance_condition3" name="calc[<?php echo $cnt2; ?>][flowresistance_condition3]"  type="text" maxlength="255" value="<?php echo $row1['flowresistance_condition3']; ?>"></td>
                      <td width="20%"><input style="width:120px;" id="flowresistance_condition4" name="calc[<?php echo $cnt2; ?>][flowresistance_condition4]"  type="text" maxlength="255" value="<?php echo $row1['flowresistance_condition4']; ?>" onKeyPress="return addRowCalc(event,'calcTab');"></td>
                      <td width="2%"><input type="button" id="del2" value="Delete" <?php if($cnt2>1){ echo 'onclick="removeRow(this,\'calcTab\')"'; } ?>></td>
                    </tr>
                      <?php
											$cnt2++;
										}	
									}							
								}else{
								?>
                      <tr>
                      <td width="18%"><select class="element select long" id="parameter1" name="calc[1][parameter]">
                          <option value=""></option>
                          <?php														
											foreach($labConfig['tab3']['parameter'] as $key => $value) {
												echo "<option value=". $key .">". $value ."</option>";
											}													
										?>
                        </select></td>
                      <td width="20%"><input style="width:120px;" id="flowresistance_condition1" name="calc[1][flowresistance_condition1]"  type="text" maxlength="255" value=""></td>
                      <td width="20%"><input style="width:120px;" id="flowresistance_condition2" name="calc[1][flowresistance_condition2]"  type="text" maxlength="255" value=""></td>
                      <td width="20%"><input style="width:120px;" id="flowresistance_condition3" name="calc[1][flowresistance_condition3]"  type="text" maxlength="255" value=""></td>
                      <td width="20%"><input style="width:120px;" id="flowresistance_condition4" name="calc[1][flowresistance_condition4]"  type="text" maxlength="255" value="" onKeyPress="return addRowCalc(event,'calcTab');"></td>
                      <td width="2%"><input type="button" id="del2" value="Delete"></td>
                    </tr>
                      <?php } ?>
                    </table>
					</td>
					</tr>
				</table>
                </div>

            </div>
            		<div class="c12">
	                	<label  for="comment1">Comment </label>
	                	<textarea class="w91" id="comment3" name="comment3"><?php echo $comment; ?></textarea>                   
	          		</div>
	          		<?php //unset($comment);?>
            </div>
        <div id="tabs-4" class="row">
              <?php 
					$tableName = 'labasd_complications';
					if($_REQUEST['search_id'] && checkUserHasPermission('labasd_demographics', $_REQUEST['search_id']) && checkTableRowExists($tableName, $_REQUEST['search_id'])){							 
						$result = getTableDataQuery($tableName, $_REQUEST['search_id']);
						if(mysql_num_rows($result)>0){ 
							$row1 = mysql_fetch_assoc($result);								
							foreach($row1 as $key=>$val){
								${$key} = $val;
							}
						} 
					}?>
            <div class="col2 c12 pl10"> 
			<div class="c10">
                <div class="c12"><h6 class="blue">Complications</h6></div>
                <div class="c12 blockTitle"><label class="mb0 headTitle" for="groin">Groin: </label></div>
                <div class="c12">
					<div class="c6">
						<input class="fl mr8" type="checkbox" id="groinhematoma" name="groinhematoma" <?php if($groinhematoma=='1') echo 'checked="checked"';?> value="1" />
						<label class="w91" for="groinhematoma">Hematoma Requiring Prolonged Compression</label>
						
					</div>
					
					<div class="c6">
						<input class="fl mr8" type="checkbox" id="groinbleeding" name="groinbleeding" <?php if($groinbleeding=='1') echo 'checked="checked"';?> value="1" />
						<label class="w91" for="groinbleeding">Bleeding Requiring Blood Transfusion</label>
					</div>						
                </div>                
                <div class="c12">
                    <div class="c6">
					    <input class="fl mr8" type="checkbox" id="faocclussion" name="faocclussion" <?php if($faocclussion=='1') echo 'checked="checked"';?> value="1" />
						<label class="w91" for="faocclussion">Femoral Artery Occlusion causing Limb Ischemia</label>
					</div>
                    <div class="c6">			
                        <input class="fl mr8" type="checkbox" id="fvocclussion" name="fvocclussion" <?php if($fvocclussion=='1') echo 'checked="checked"';?> value="1" />
						<label class="w91" for="fvocclussion">Femoral Vein Occlusion causing Limb Odema</label>
					</div>
                </div>
                <div class="c12 blockTitle">
                      <label class="mb0 headTitle" for="airemb">Air embolism: </label>
                </div>
                <div class="c12">
                    <label  for="airemb_transtele">Transient ST elevation</label>
					<select  id="airemb_transtele" name="airemb_transtele">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab4']['malpos'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($airemb_transtele==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                    </select>
				</div>
                <div class="c12">
                    <label  for="airemb_hemodyn">Hemodynamic Collapse</label>
					<select  id="airemb_hemodyn" name="airemb_hemodyn">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab4']['malpos'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($airemb_hemodyn==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                    </select>
                </div>
                <div class="c12">
                    <label  for="airemb_hemodyn">Others</label>
					<input id="others_airemb" name="others_airemb"  type="text" maxlength="255" value="<?php echo $others_airemb; ?>"/>
                </div>
                <div class="c12 blockTitle">
				<label class="mb0 headTitle" for="airemb_thromboemb">Thrombo embolism</label>
				</div>				
				<div class="c12">
                    <label  for="airemb_thromboemb">Thrombo embolism</label>
					<select  id="airemb_thromboemb" name="airemb_thromboemb" onChange="displayIfYes(this, 'thromboembifyes')">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab4']['malpos'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($airemb_thromboemb==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                    </select>
				</div>
                <div class="c12" id="thromboembifyes" style="display:<?php if($airemb_thromboemb=='1') echo 'block'; else echo 'none'; ?>">
					<label for="airemb_thromboembifyes">If yes description</label>
					<textarea id="airemb_thromboembifyes" name="airemb_thromboembifyes" ><?php echo $airemb_thromboembifyes; ?></textarea>
				</div>
				<div class="c12">
					<label  for="throemb_cva">CVA</label>
					<select  id="throemb_cva" name="throemb_cva">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab4']['malpos'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($throemb_cva==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                    </select>
				</div>
				<div class="c12">
					<label  for="periemb">Peripheral Embolism</label>
					<select  id="periemb" name="periemb">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab4']['malpos'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($periemb==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                    </select>
				</div>
				<div class="c12">
					<label  for="periemb_othrs">Others</label>
					<input id="periemb_othrs" name="periemb_othrs"  type="text" maxlength="255" value="<?php echo $periemb_othrs; ?>"/>
				</div>
				<div class="c12 blockTitle">
				<label class="mb0 headTitle" for="airemb_deviceemb">Device embolisation</label></div>
				<div class="c12">
					<label for="airemb_deviceemb">Device embolisation</label>
					<select id="airemb_deviceemb" name="airemb_deviceemb" onChange="displayIfYes(this, 'airembDeviceembifyes')">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab4']['malpos'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($airemb_deviceemb==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                    </select>
				</div>
				<div id="airembDeviceembifyes" style="display:<?php if($airemb_deviceemb=='1') echo 'block'; else echo 'none'; ?>" class="c12">
					<label for="airemb_deviceembifyes">If yes detailed description</label>
					<textarea id="airemb_deviceembifyes" name="airemb_deviceembifyes"><?php echo $airemb_deviceembifyes; ?></textarea>
				</div>
				<div class="c12">
					<label  for="airemb_retrieval">Retrieval</label>
					<select  id="airemb_retrieval" name="airemb_retrieval">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab4']['airemb_retrieval'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($airemb_retrieval==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                    </select>
				</div>
                <div class="c12">
					<label  for="airemb_proccomplete">Completion of Procedure</label>
					<select  id="airemb_proccomplete" name="airemb_proccomplete">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab4']['airemb_proccomplete'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($airemb_proccomplete==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                    </select>
				</div>
				
				<div class="c12 blockTitle">
                      <label class="mb0 headTitle" for="cardiac_defect">Cardiac Structural Defect: </label>
                </div>
                <div class="c12">
                    <label  for="perc_effusion">Percardial Effusion</label>
					<select  id="perc_effusion" name="perc_effusion">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab4']['malpos'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($perc_effusion==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                    </select>
				</div>
				<div class="c12">
                    <label  for="card_perc">Cardiac Tamponade Requiring Percardiocentesis</label>
					<select  id="card_perc" name="card_perc">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab4']['malpos'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($card_perc==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                    </select>
				</div>
				<div class="c12">
					<div class="c6 pl0">
	                    <label for="onset_mr">New Onset MR</label>
						<select id="onset_mr" name="onset_mr" onChange="displayIfYes(this, 'onsetMrGrade')">
	                          <option value="" selected="selected"></option>
	                          <?php
	                          foreach($labConfig['tab4']['malpos'] as $key => $value) { ?>
	                          <option value="<?php echo $key; ?>" <?php if($onset_mr==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
	                          <?php } ?>
	                    </select>
	                 </div>
	                 <div id="onsetMrGrade" class="c6" style="display:<?php if($onset_mr=='1') echo 'block'; else echo 'none'; ?>">
	                    <label for="onset_mr_grade">Grade</label>
						<select id="onset_mr_grade" name="onset_mr_grade">
	                          <option value="" selected="selected"></option>
	                          <?php
														
														foreach($labConfig['general']['pdechomrseverity'] as $key => $value) {
															?>
	                          <option value="<?php echo $key; ?>" <?php if($onset_mr_grade==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
	                          <?php
														}													
													?>
	                    </select>
	                 </div>
				</div>
				<div class="c12">
					<div class="c6 pl0">
	                    <label for="onset_tr">New Onset TR</label>
						<select id="onset_tr" name="onset_tr" onChange="displayIfYes(this, 'onsetTrGrade')">
	                          <option value="" selected="selected"></option>
	                          <?php
	                          foreach($labConfig['tab4']['malpos'] as $key => $value) { ?>
	                          <option value="<?php echo $key; ?>" <?php if($onset_tr==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
	                          <?php } ?>
	                    </select>
	                 </div>
	                 <div id="onsetTrGrade" class="c6" style="display:<?php if($onset_tr=='1') echo 'block'; else echo 'none'; ?>">
	                    <label for="onset_tr_grade">Grade</label>
						<select id="onset_tr_grade" name="onset_tr_grade">
	                          <option value="" selected="selected"></option>
	                          <?php
														
														foreach($labConfig['general']['pdechomrseverity'] as $key => $value) {
															?>
	                          <option value="<?php echo $key; ?>" <?php if($onset_tr_grade==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
	                          <?php
														}													
													?>
	                    </select>
	                 </div>
				</div>
				<div class="c12">
					<div class="c6 pl0">
	                    <label for="onset_ar">New Onset AR</label>
						<select id="onset_ar" name="onset_ar" onChange="displayIfYes(this, 'onsetArGrade')">
	                          <option value="" selected="selected"></option>
	                          <?php
	                          foreach($labConfig['tab4']['malpos'] as $key => $value) { ?>
	                          <option value="<?php echo $key; ?>" <?php if($onset_ar==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
	                          <?php } ?>
	                    </select>
	                 </div>
	                 <div id="onsetArGrade" class="c6" style="display:<?php if($onset_ar=='1') echo 'block'; else echo 'none'; ?>">
	                    <label for="onset_ar_grade">Grade</label>
						<select id="onset_ar_grade" name="onset_ar_grade">
	                          <option value="" selected="selected"></option>
	                          <?php
														
														foreach($labConfig['general']['pdechomrseverity'] as $key => $value) {
															?>
	                          <option value="<?php echo $key; ?>" <?php if($onset_ar_grade==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
	                          <?php
														}													
													?>
	                    </select>
	                 </div>
				</div>
				<div class="c12">
					<label  for="cardiac_othrs">Others</label>
					<input id="cardiac_othrs" name="cardiac_othrs"  type="text" maxlength="255" value="<?php echo $cardiac_othrs; ?>"/>
				</div>
			</div>
            <div class="c10">
                      <div class="c12 mTop15 blockTitle"><label class="mb0 headTitle" for="rhythmdis">Rhythm disturbance: </label></div>
                      <div class="c12"><label  for="rhythmdis_tachycardia">Tachycardia requiring cardioversion or medication: </label>
					  <select  id="rhythmdis_tachycardia" name="rhythmdis_tachycardia">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab4']['malpos'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($rhythmdis_tachycardia==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
                      <div class="c12"><label  for="rhythmdis_heartblk">Heart Block: </label>
					  <select  id="rhythmdis_heartblk" name="rhythmdis_heartblk">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab4']['rhythmdis_heartblk'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($rhythmdis_heartblk==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
                      </div>
                      <div class="c12 mTop15 blockTitle">
                      	<label class="mb0 headTitle" for="postDepComp">Post Deployment Complications: </label>
                	  </div>
                	  <div class="c12"><label for="residual_shunt">Residual Shunt: </label>
					  <select  id="residual_shunt" name="residual_shunt">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab4']['malpos'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($residual_shunt==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
                      </div>
                      <div class="c12"><label  for="rhythmdis_postdeploypuledema">Post deployment pulmonary edema: </label>
					  <select  id="rhythmdis_postdeploypuledema" name="rhythmdis_postdeploypuledema">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab4']['malpos'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($rhythmdis_postdeploypuledema==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
                      </div>
                      <div class="c12"><label  for="rhythmdis_feverafterdeploy">Post deployment fever: </label>
					  <select  id="rhythmdis_feverafterdeploy" name="rhythmdis_feverafterdeploy">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab4']['malpos'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($rhythmdis_feverafterdeploy==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
                      <div class="c12"><label  for="rhythmdis_othercomp">Other complications: </label>
					  <select id="rhythmdis_othercomp" name="rhythmdis_othercomp" onChange="displayIfYes(this, 'rhythmdisOthercompifyes')">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab4']['malpos'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($rhythmdis_othercomp==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
                      <div id="rhythmdisOthercompifyes" style="display:<?php if($rhythmdis_othercomp=='1') echo 'block'; else echo 'none'; ?>" class="c12">
	                      <label  for="rhythmdis_othercompifyes">If yes, Details: </label>
						  <textarea id="rhythmdis_othercompifyes" name="rhythmdis_othercompifyes" ><?php echo $rhythmdis_othercompifyes; ?></textarea>
					  </div>
                      <div class="c12"><label  for="rhythmdis_cardiactamp">Cardiac Tamponent: </label>
					  <select  id="rhythmdis_cardiactamp" name="rhythmdis_cardiactamp" onChange="displayIfYes(this, 'cardiactampifyes')">
                          <option value="" selected="selected"></option>
                          <?php
													
													foreach($labConfig['tab4']['malpos'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($rhythmdis_cardiactamp==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
                      <div class="c12" id="cardiactampifyes" style="display:<?php if($rhythmdis_cardiactamp=='1') echo 'block'; else echo 'none'; ?>">
                      <label  for="rhythmdis_cardiactampifyes">if yes,  description </label>
					  <textarea id="rhythmdis_cardiactampifyes" name="rhythmdis_cardiactampifyes" ><?php echo $rhythmdis_cardiactampifyes; ?></textarea></div>
                    </div>
                    
					<div class="c12">
	                	<label  for="comment1">Comment </label>
	                	<textarea class="w91" id="comment4" name="comment4"><?php echo $comment; ?></textarea>                   
	          		</div></div>
        </div>
            
        <div id="tabs-5" class="row">
              <?php 
				$tableName = 'labasd_postdeployecho';
					if($_REQUEST['search_id'] && checkUserHasPermission('labasd_demographics', $_REQUEST['search_id']) && checkTableRowExists($tableName, $_REQUEST['search_id'])){							 
						$result = getTableDataQuery($tableName, $_REQUEST['search_id']);
						if(mysql_num_rows($result)>0){ 
							$row1 = mysql_fetch_assoc($result);								
							foreach($row1 as $key=>$val){
								${$key} = $val;
							}
						} 
					}?>
              
			  <div class="col1 c12">
                <div class="c12"><h6 class="blue mt0">Post Deployment Echo</h6></div>
                <div class="c12">
					<div class="c6">
						<label  for="resflow">Residual flows</label>
						<select  id="resflow" name="resflow" onChange="displayIfYes(this, 'resflowyes')">
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['resflow'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($resflow==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
					</div>
					<div class="c6" id="resflowyes" style="display:<?php if($resflow=='1') echo 'block'; else echo 'none'; ?>">
					    <label class="ml5 w30" for="resflowyes">If yes:</label>
						<select  id="resflowyes" name="resflowyes">
                              <option value="" selected="selected"></option>
                              <?php
														
																foreach($labConfig['general']['resflowyesasd'] as $key => $value) {
																	?>
                              <option value="<?php echo $key; ?>" <?php if($resflowyes==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                              <?php
																}													
															?>
                            </select>
					</div>
                </div>
				
				<div class="c12">
				<div class="c6">
						<label  for="mitralvalve">Contact with mitral valve</label>
						<select  id="mitralvalve" name="mitralvalve">
							  <option value="" selected="selected"></option>
							  <?php
															
														foreach($labConfig['general']['resflow'] as $key => $value) {
															?>
							  <option value="<?php echo $key; ?>" <?php if($mitralvalve==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
							  <?php
														}													
													?>
						</select>
				</div>
				</div>
				<div class="c12">
                    <div class="c6">
						<label  for="pdechomr">MR:</label>
						<select  id="pdechomr" name="pdechomr" onChange="displayIfYes(this, 'pdechomrifyes')">
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['resflow'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($pdechomr==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
					</div>
                    <div class="c6" id="pdechomrifyes" style="display:<?php if($pdechomr=='1') echo 'block'; else echo 'none'; ?>">
						<label class="ml5 w30" for="pdechomrseverity">If yes: Severity</label>
						<select  id="pdechomrseverity" name="pdechomrseverity">
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['pdechomrseverity'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($pdechomrseverity==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
					</div>
                </div>
                <div class="c12">
					<div class="c6">
					<label  for="pdechotr">TR:</label>
					<select id="pdechotr" name="pdechotr" onChange="displayIfYes(this, 'pdechotrIfYes')">
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['resflow'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($pdechotr==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                    </select>
					</div>
                    <div class="c6" id="pdechotrIfYes" style="display:<?php if($pdechotr=='1') echo 'block'; else echo 'none'; ?>">
						<div class="c6 pl0">
						<label class="ml5 w30" for="pdechotrrvsp">If yes RSVP:</label>
						<input id="pdechotrrvsp" name="pdechotrrvsp"  type="text" maxlength="255" value="<?php echo $pdechotrrvsp; ?>"/></div>
						<div class="c6">
							<label class="ml5 w30" for="pdechotrseverity">Severity:</label>
							<select  id="pdechotrseverity" name="pdechotrseverity">
                              <option value="" selected="selected"></option>
                              <?php
														
																foreach($labConfig['general']['pdechomrseverity'] as $key => $value) {
																	?>
                              <option value="<?php echo $key; ?>" <?php if($pdechotrseverity==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                              <?php
																}													
															?>
                            </select>
						</div>
					</div>
					</div>
				<div class="c12">
					<div class="c6"><label  for="pdechoar">AR:</label>
					<select id="pdechoar" name="pdechoar" onChange="displayIfYes(this, 'pdechoarIfYes')">
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['resflow'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($pdechoar==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
					</div>
					
                    <div class="c6" id="pdechoarIfYes" style="display:<?php if($pdechoar=='1') echo 'block'; else echo 'none'; ?>">
                    <label class="ml5 w30" for="pdechoarseverity">If yes: Severity</label>
						<select id="pdechoarseverity" name="pdechoarseverity">
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['pdechomrseverity'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($pdechoarseverity==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
						</div>
				</div>
                <div class="c12">
					<div class="c6">
					<label  for="pericardialeff">Pericardial effusion:</label>
					<select id="pericardialeff" name="pericardialeff" onChange="displayIfYes(this, 'pericardialeffIfYes')">
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['resflow'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($pericardialeff==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
					</div>
					<div class="c6" id="pericardialeffIfYes" style="display:<?php if($pericardialeff=='1') echo 'block'; else echo 'none'; ?>">
                        <label class="ml5 w30" for="pericardialeffifyes">If yes: Severity</label>
						<select  id="pericardialeffifyes" name="pericardialeffifyes">
                          <option value="" selected="selected"></option>
                          <?php														
													foreach($labConfig['general']['pdechomrseverity'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($pericardialeffifyes==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
					</div>
				</div>
                <div class="c12">
					<div class="c6"><label  for="deviceprof">Device profile in mm:</label>
					<input id="deviceprof" name="deviceprof"  type="text" maxlength="255" value="<?php echo $deviceprof; ?>"/>
					</div>
				</div>
                <div class="c12">
                <div class="c6">
					<label  for="findings">Any other noteworthy findings:</label>
					<textarea id="findings" name="findings" class="w100 element textarea medium"><?php echo $findings; ?></textarea>
				</div>
				</div>              
            </div>
            <div class="c12">
              	<label  for="comment1">Comment </label>
              	<textarea class="w91" id="comment5" name="comment5"><?php echo $comment; ?></textarea>                   
          	</div>
          	<?php 
					$tableName = 'labasd_postdeployecho';
					if($_REQUEST['search_id'] && checkUserHasPermission('labasd_demographics', $_REQUEST['search_id']) && checkTableRowExists($tableName, $_REQUEST['search_id'])){
						$result = getTableDataQuery($tableName, $_REQUEST['search_id']);
						if(mysql_num_rows($result)>0){
							$row1 = mysql_fetch_assoc($result);
							foreach($row1 as $key=>$val){
								unset(${$key});
							}
						}
					}				
				?>
            </div>
        <div id="tabs-6" class="row">
              <?php 
				$tableName = 'labasd_followupecho';
					if($_REQUEST['search_id'] && checkUserHasPermission('labasd_demographics', $_REQUEST['search_id']) && checkTableRowSectionExists($tableName, $_REQUEST['search_id'], 'asd_e1')){							 
						$result = getTableDataQuerySection($tableName, $_REQUEST['search_id'], 'asd_e1');
						if(mysql_num_rows($result)>0){ 
							$row1 = mysql_fetch_assoc($result);								
							foreach($row1 as $key=>$val){
								${$key} = $val;
							}
						} 
					}?>
              <input type="hidden" id="section" name="section" value="asd_e1" />
           
            <div class="col1 c12">
            <!-- <div class="c12 mTop15">
				<label>Pre Discharge ECHO and ECG</label>
			</div> -->
			<div class="c12">
				<h6 class="blue mt0">Pre Discharge ECHO and ECG</h6>
			</div>
                <div class="c12">
					<div class="c6">
					<label  for="resflow">Residual flows</label>
					<select id="resflow11" name="resflow11" >
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['resflow'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($resflow==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                    </select>
					</div>
				</div>
                <div class="c12">
					<div class="c6">
					<label  for="mitralvalve">Contact with mitral valve</label>
					<select  id="mitralvalve11" name="mitralvalve11">
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['resflow'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($mitralvalve==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
					</div>
				</div>
                <div class="c12">
					<div class="c6">
					<label  for="pdechomr">MR:</label>
					<select id="pdechomr11" name="pdechomr11" onChange="displayIfYes(this, 'pdechomr11IfYes')">
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['resflow'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($pdechomr==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
					</div>
                    <div class="c6" id="pdechomr11IfYes" style="display:<?php if($pdechomr=='1') echo 'block'; else echo 'none'; ?>">
						<label class="ml5 w30" for="pdechomrseverity">If yes: Severity</label>
						<select  id="pdechomrseverity11" name="pdechomrseverity11">
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['pdechomrseverity'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($pdechomrseverity==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
					</div>
					</div>
                    <div class="c12">
                    <div class="c6">
						<label  for="pdechotr">TR:</label>
						<select  id="pdechotr11" name="pdechotr11" onChange="displayIfYes(this, 'pdechotr11IfYes')">
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['resflow'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($pdechotr==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
						</div>
						<div class="c6" id="pdechotr11IfYes" style="display:<?php if($pdechotr=='1') echo 'block'; else echo 'none'; ?>">
                        <div class="c6 pl0">
						<label class="ml5 w30" for="pdechotrrvsp">If yes RSVP:</label>
						<input id="pdechotrrvsp11" name="pdechotrrvsp11"  type="text" maxlength="255" value="<?php echo $pdechotrrvsp; ?>"/></div>
						<div class="c6"><label class="ml5 w30" for="pdechotrseverity">Severity:</label>
						<select  id="pdechotrseverity11" name="pdechotrseverity11">
                              <option value="" selected="selected"></option>
                              <?php
														
																foreach($labConfig['general']['pdechomrseverity'] as $key => $value) {
																	?>
                              <option value="<?php echo $key; ?>" <?php if($pdechotrseverity==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                              <?php
																}													
															?>
                            </select>
							</div>
							</div>
							</div>
                        <div class="c12">
                        <div class="c6">
							<label  for="pericardialeff">Pericardial effusion:</label>
							<select  id="pericardialeff11" name="pericardialeff11" onChange="displayIfYes(this, 'pericardialeff11IfYes')">
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['resflow'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($pericardialeff==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
						<div class="c6" id="pericardialeff11IfYes" style="display:<?php if($pericardialeff=='1') echo 'block'; else echo 'none'; ?>">
							<label class="ml5 w30" for="pericardialeffifyes11">If yes: Severity</label>
							<select  id="pericardialeffifyes11" name="pericardialeffifyes11">
	                              <option value="" selected="selected"></option>
	                              <?php
															
																	foreach($labConfig['general']['pdechomrseverity'] as $key => $value) {
																		?>
	                              <option value="<?php echo $key; ?>" <?php if($pericardialeffifyes==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
	                              <?php
																	}													
																?>
	                         </select>
						</div>						
					</div>
                    <div class="c12">
						<div class="c6">
							<label  for="deviceprof">Device profile in mm:</label>
							<input id="deviceprof11" name="deviceprof11"  type="text" maxlength="255" value="<?php echo $deviceprof; ?>"/>
							</div>
							</div>
                    <div class="c12">
						<div class="c6">
							<label  for="findings">Any other noteworthy findings:</label>
							<textarea id="findings11" name="findings11" class="w100 element textarea medium"><?php echo $findings; ?></textarea>
						</div>
					</div>
                    <div class="c12 mt10">
						<div class="c6">
						<label  for="clotson">Clots on:</label>
						<input id="clotson11" name="clotson11"  type="text" maxlength="255" value="<?php echo $clotson; ?>"/>
					</div>
					</div>
					<div class="c12">
					<div class="c6 blockTitle">
                      	<label class="mb0 headTitle" for="preDisECG">Pre Discharge ECG: </label>
                	</div>
                	</div>
                	<div class="c12">
                	<div class="c6">
	                	  <label for="rhythm">Rhythm: </label>
						  <select id="rhythm" name="rhythm">
	                          <option value="" selected="selected"></option>
	                          <?php														
							  foreach($labConfig['general']['rhythm'] as $key => $value) { ?>
	                          <option value="<?php echo $key; ?>" <?php if($rhythm==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
	                          <?php } ?>
	                      </select>
                    </div>
                    </div>
                    <div class="c12">
                    <div class="c6">
	                	  <label for="cond_disturbances">Conduction Disturbances: </label>
						  <select id="cond_disturbances" name="cond_disturbances">
	                          <option value="" selected="selected"></option>
	                          <?php														
							  foreach($labConfig['general']['cond_disturbances'] as $key => $value) { ?>
	                          <option value="<?php echo $key; ?>" <?php if($cond_disturbances==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
	                          <?php } ?>
	                      </select>
                    </div>
                    </div>
                    <div class="c12">
						<div class="c6">
						<label  for="qrs_axis">QRS Axis:</label>
						<input id="qrs_axis" name="qrs_axis"  type="text" maxlength="255" value="<?php echo $qrs_axis; ?>"/>
					</div>
					</div>
                    <div class="c12">
						<div class="c6">
						<label  for="medication">Medication:</label>
						<input id="medication11" name="medication11"  type="text" maxlength="255" value="<?php echo $medication; ?>"/>
					</div>
					</div>                  
              
            </div>
            <div class="c12">
              	<label  for="comment1">Comment </label>
              	<textarea class="w91" id="comment6" name="comment6"><?php echo $comment; ?></textarea>                   
          	</div>
          	<?php 
				if($_REQUEST['search_id'] && checkUserHasPermission('labasd_demographics', $_REQUEST['search_id'])){
					$result = getTableDataQuerySection($tableName, $_REQUEST['search_id'], 'asd_e1');
					if(mysql_num_rows($result)>0){
						$row1 = mysql_fetch_assoc($result);
						foreach($row1 as $key=>$val){
							unset(${$key});
						}
					}
				}
				?>
            </div>
        <div id="tabs-7" class="row">
              <?php 
				$tableName = 'labasd_followupecho';
					if($_REQUEST['search_id'] && checkUserHasPermission('labasd_demographics', $_REQUEST['search_id']) && checkTableRowSectionExists($tableName, $_REQUEST['search_id'], 'asd_e2')){							 
						$result = getTableDataQuerySection($tableName, $_REQUEST['search_id'], 'asd_e2');
						if(mysql_num_rows($result)>0){ 
							$row1 = mysql_fetch_assoc($result);								
							foreach($row1 as $key=>$val){
								${$key} = $val;
							}
						} 
					}?>
              <input type="hidden" id="section1" name="section1" value="asd_e2" />
              <div class="col1 c12">
				<div class="c12">
				<h6 class="blue mt0">Follow up ECHO - 3 Month</h6></div>
				<div class="c12">
					<div class="c6"><label  for="resflow">Residual flows</label>
					<select  id="resflow1" name="resflow1">
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['resflow'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($resflow==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
					</div>
				</div>
                <div class="c12">
					<div class="c6">
					<label  for="mitralvalve">Contact with mitral valve</label>
					<select  id="mitralvalve1" name="mitralvalve1">
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['resflow'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($mitralvalve==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
					</div>
				</div>
                <div class="c12">
					<div class="c6">
						<label  for="pdechomr">MR:</label>
						<select id="pdechomr1" name="pdechomr1" onChange="displayIfYes(this, 'pdechomr1IfYes')">
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['resflow'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($pdechomr==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
					<div class="c6" id="pdechomr1IfYes" style="display:<?php if($pdechomr=='1') echo 'block'; else echo 'none'; ?>">
						<label class="w30" for="pdechomrseverity">If yes: Severity</label>
						<select  id="pdechomrseverity1" name="pdechomrseverity1">
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['pdechomrseverity'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($pdechomrseverity==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
					</div>
					</div>
                    <div class="c12">
						<div class="c6">
							<label  for="pdechotr">TR:</label>
							<select id="pdechotr1" name="pdechotr1" onChange="displayIfYes(this, 'pdechotr1IfYes')">
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['resflow'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($pdechotr==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
						</div>
						<div class="c6" id="pdechotr1IfYes" style="display:<?php if($pdechotr=='1') echo 'block'; else echo 'none'; ?>">
							<div class="c6 pl0">
							<label class="w30" for="pdechotrrvsp">If yes RSVP:</label>
							<input id="pdechotrrvsp1" name="pdechotrrvsp1"  type="text" maxlength="255" value="<?php echo $pdechotrrvsp; ?>"/>
							</div>
							<div class="c6">
							<label class="w30" for="pdechotrseverity">Severity:</label>
							<select  id="pdechotrseverity1" name="pdechotrseverity1">
                              <option value="" selected="selected"></option>
                              <?php
														
																foreach($labConfig['general']['pdechomrseverity'] as $key => $value) {
																	?>
                              <option value="<?php echo $key; ?>" <?php if($pdechotrseverity==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                              <?php
																}													
															?>
                            </select>
							</div>
							</div>
							</div>
                        <div class="c12">
							<div class="c6">
								<label  for="pericardialeff">Pericardial effusion:</label>
								<select  id="pericardialeff1" name="pericardialeff1" onChange="displayIfYes(this, 'pericardialeff1IfYes')">
		                          <option value="" selected="selected"></option>
		                          <?php
																
															foreach($labConfig['general']['resflow'] as $key => $value) {
																?>
		                          <option value="<?php echo $key; ?>" <?php if($pericardialeff==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
		                          <?php
															}													
														?>
		                        </select>
	                        </div>						
							<div class="c6" id="pericardialeff1IfYes" style="display:<?php if($pericardialeff=='1') echo 'block'; else echo 'none'; ?>">
								<label class="ml5 w30" for="pericardialeffifyes1">If yes: Severity</label>
								<select  id="pericardialeffifyes1" name="pericardialeffifyes1">
		                              <option value="" selected="selected"></option>
		                              <?php
																
																		foreach($labConfig['general']['pdechomrseverity'] as $key => $value) {
																			?>
		                              <option value="<?php echo $key; ?>" <?php if($pericardialeffifyes==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
		                              <?php
																		}													
																	?>
		                         </select>
							</div>						
					</div>
                    <div class="c12">
                    <div class="c6">
						<label  for="deviceprof">Device profile in mm:</label>
						<input id="deviceprof1" name="deviceprof1"  type="text" maxlength="255" value="<?php echo $deviceprof; ?>"/></div>
                    </div>
                     <div class="c12">
                     <div class="c6">
					 <label  for="findings">Any other noteworthy findings:</label>
					 <textarea id="findings1" name="findings1" ><?php echo $findings; ?></textarea>
					 </div>
					 </div>
                    <div class="c12">
						<div class="c6">
						<label  for="clotson">Clots on:</label>
						<input id="clotson1" name="clotson1"  type="text" maxlength="255" value="<?php echo $clotson; ?>"/>
						</div>
						</div>
					<div class="c12">
                      	<label for="preDisECG">Pre Discharge ECG: </label>
                	</div>
                	<div class="c12">
                	<div class="c6">
	                	  <label for="rhythm1">Rhythm: </label>
						  <select id="rhythm1" name="rhythm1">
	                          <option value="" selected="selected"></option>
	                          <?php														
							  foreach($labConfig['general']['rhythm'] as $key => $value) { ?>
	                          <option value="<?php echo $key; ?>" <?php if($rhythm==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
	                          <?php } ?>
	                      </select>
                    </div>
                    </div>
                    <div class="c12">
                    <div class="c6">
	                	  <label for="cond_disturbances1">Conduction Disturbances: </label>
						  <select id="cond_disturbances1" name="cond_disturbances1">
	                          <option value="" selected="selected"></option>
	                          <?php														
							  foreach($labConfig['general']['cond_disturbances'] as $key => $value) { ?>
	                          <option value="<?php echo $key; ?>" <?php if($cond_disturbances==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
	                          <?php } ?>
	                      </select>
                    </div>
                    </div>
                    <div class="c12">
						<div class="c6">
						<label  for="qrs_axis1">QRS Axis:</label>
						<input id="qrs_axis1" name="qrs_axis1"  type="text" maxlength="255" value="<?php echo $qrs_axis; ?>"/>
					</div>
					</div>
                    <div class="c12">
                    <div class="c6">
					<label  for="medication">Medication:</label>
					<input id="medication1" name="medication1" type="text" maxlength="255" value="<?php echo $medication; ?>"/>
					</div>
					</div>
					</div>
					<div class="c12">
		              	<label  for="comment1">Comment </label>
		              	<textarea class="w91" id="comment7" name="comment7"><?php echo $comment; ?></textarea>                   
		          	</div>
                    
              <?php 
				if($_REQUEST['search_id']){
					$result = getTableDataQuerySection($tableName, $_REQUEST['search_id'], 'asd_e2');
					if(mysql_num_rows($result)>0){
						$row1 = mysql_fetch_assoc($result);
						foreach($row1 as $key=>$val){
							unset(${$key});
						}
					}
				}
				?>
            </div>
        <div id="tabs-8" class="row">
              <?php 
					$tableName = 'labasd_followupecho';
					if($_REQUEST['search_id'] && checkUserHasPermission('labasd_demographics', $_REQUEST['search_id']) && checkTableRowSectionExists($tableName, $_REQUEST['search_id'], 'asd_e3')){							 
						$result = getTableDataQuerySection($tableName, $_REQUEST['search_id'], 'asd_e3');
						if(mysql_num_rows($result)>0){ 
							$row1 = mysql_fetch_assoc($result);								
							foreach($row1 as $key=>$val){
								${$key} = $val;
							}
						} 
					}?>
              <input type="hidden" id="section2" name="section2" value="asd_e3" />
              <div class="col1 c12">
              <div class="c12">
				<h6 class="blue mt0">Follow up ECHO - 1 Year</h6>
			</div>
               <div class="c12">
               <div class="c6">
					<label  for="resflow">Residual flows</label>
					<select  id="resflow2" name="resflow2">
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['resflow'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($resflow==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
						
					</div>
					</div>
                   <div class="c12">
					<div class="c6">
						<label  for="mitralvalve">Contact with mitral valve</label>
						<select  id="mitralvalve2" name="mitralvalve2">
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['resflow'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($mitralvalve==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
						</div>
						</div>
                    <div class="c12">
                    <div class="c6">
						<label  for="pdechomr">MR:</label>
						<select id="pdechomr2" name="pdechomr2" onChange="displayIfYes(this, 'pdechomr2IfYes')">
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['resflow'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($pdechomr==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
						<div class="c6" id="pdechomr2IfYes" style="display:<?php if($pdechomr=='1') echo 'block'; else echo 'none'; ?>">
						<label class="pl0 w30" for="pdechomrseverity">If yes: Severity</label>
						<select  id="pdechomrseverity2" name="pdechomrseverity2">
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['pdechomrseverity'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($pdechomrseverity==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
						</div>
						</div>
                    <div class="c12">
						<div class="c6">
							<label  for="pdechotr">TR:</label>
							<select id="pdechotr2" name="pdechotr2" onChange="displayIfYes(this, 'pdechotr2IfYes')">
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['resflow'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($pdechotr==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select></div>
						<div class="c6" id="pdechotr2IfYes" style="display:<?php if($pdechotr=='1') echo 'block'; else echo 'none'; ?>">
						<div class="c6 pl0">
							<label class="w30" for="pdechotrrvsp">If yes RSVP:</label>
							<input id="pdechotrrvsp2" name="pdechotrrvsp2"  type="text" maxlength="255" value="<?php echo $pdechotrrvsp; ?>"/>
							</div>
							
						<div class="c6">
							<label class="w30" for="pdechotrseverity">Severity:</label>
							<select  id="pdechotrseverity2" name="pdechotrseverity2">
                              <option value="" selected="selected"></option>
                              <?php
														
																foreach($labConfig['general']['pdechomrseverity'] as $key => $value) {
																	?>
                              <option value="<?php echo $key; ?>" <?php if($pdechotrseverity==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                              <?php
																}													
															?>
                            </select></div>
							</div>
							</div>
							<div class="c12">
							<div class="c6">
								<label  for="pericardialeff">Pericardial effusion:</label>
								<select id="pericardialeff2" name="pericardialeff2" onChange="displayIfYes(this, 'pericardialeff2IfYes')">
                          <option value="" selected="selected"></option>
                          <?php
														
													foreach($labConfig['general']['resflow'] as $key => $value) {
														?>
                          <option value="<?php echo $key; ?>" <?php if($pericardialeff==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
                          <?php
													}													
												?>
                        </select>
						</div>
						<div class="c6" id="pericardialeff2IfYes" style="display:<?php if($pericardialeff=='1') echo 'block'; else echo 'none'; ?>">
							<label class="ml5 w30" for="pericardialeffifyes2">If yes: Severity</label>
							<select  id="pericardialeffifyes2" name="pericardialeffifyes2">
	                              <option value="" selected="selected"></option>
	                              <?php
															
																	foreach($labConfig['general']['pdechomrseverity'] as $key => $value) {
																		?>
	                              <option value="<?php echo $key; ?>" <?php if($pericardialeffifyes==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
	                              <?php
																	}													
																?>
	                         </select>
						</div>						
                    </div>
                      <div class="c12">
                      <div class="c6">
						<label  for="deviceprof">Device profile in mm:</label>
						<input id="deviceprof2" name="deviceprof2"  type="text" maxlength="255" value="<?php echo $deviceprof; ?>"/>
						</div>
						</div>
                    
					 <div class="c12">
                      <div class="c6"><label  for="findings">Any other noteworthy findings:</label>
					  <textarea id="findings2" name="findings2" ><?php echo $findings; ?></textarea>
					  </div>
					  </div>
                     <div class="c12">
                      <div class="c6"><label  for="clotson">Clots on:</label>
					  <input id="clotson2" name="clotson2"  type="text" maxlength="255" value="<?php echo $clotson; ?>"/>
					  </div>
					  </div>
					  <div class="c12">
                      	<label for="preDisECG">Pre Discharge ECG: </label>
                	</div>
                	<div class="c12">
                	<div class="c6">
	                	  <label for="rhythm2">Rhythm: </label>
						  <select id="rhythm2" name="rhythm2">
	                          <option value="" selected="selected"></option>
	                          <?php														
							  foreach($labConfig['general']['rhythm'] as $key => $value) { ?>
	                          <option value="<?php echo $key; ?>" <?php if($rhythm==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
	                          <?php } ?>
	                      </select>
                    </div>
                    </div>
                    <div class="c12">
                    <div class="c6">
	                	  <label for="cond_disturbances2">Conduction Disturbances: </label>
						  <select id="cond_disturbances2" name="cond_disturbances2">
	                          <option value="" selected="selected"></option>
	                          <?php														
							  foreach($labConfig['general']['cond_disturbances'] as $key => $value) { ?>
	                          <option value="<?php echo $key; ?>" <?php if($cond_disturbances==$key) echo 'selected="selected"';?>><?php echo $value; ?></option>
	                          <?php } ?>
	                      </select>
                    </div>
                    </div>
                    <div class="c12">
						<div class="c6">
						<label  for="qrs_axis2">QRS Axis:</label>
						<input id="qrs_axis2" name="qrs_axis2"  type="text" maxlength="255" value="<?php echo $qrs_axis; ?>"/>
					</div>
					</div>
                     <div class="c12">
                      <div class="c6">
					  <label  for="medication">Medication:</label>
					  <input id="medication2" name="medication2"  type="text" maxlength="255" value="<?php echo $medication; ?>"/>
					  </div>
					  </div>
					  <div class="c12">
		              	<label  for="comment1">Comment </label>
		              	<textarea class="w91" id="comment8" name="comment8"><?php echo $comment; ?></textarea>                   
		          	</div>
            </div>
            </div>
			
        <div class="action">
              <input type="submit" name="form_labasd" value="Save" id="form_labasd" />
            </div>
      </form>
        </div>
  </div>
    </div>
</div>
</body>
</html>