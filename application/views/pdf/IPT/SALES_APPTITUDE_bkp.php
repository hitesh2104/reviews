		<!-- PAGE 3 -->
		<div style="font-size:18px;padding-top:10px;color:white"><b>EXECUTIVE SUMMARY</b></div>
			<br>
			<br>
			<br>
			<div class="tips">
			<table>
				<tr>
					<td>
						<p class="body1" style="color:#518FF7"><b>SALES PREDICTION INDICATOR</b></p>
						<p>The Sales Prediction Indicator is scientifically formulated based on the results from the sales aptitude, motivational drivers and learning potential assessment. </p>
					</td>
				</tr>
				<tr>
					<td>
						<br>
						<br>
						<img src="http://u-test.co.za/ah/images/sales_aptitude/SPI.png">
						<br>
						<br>
					</td>
				</tr>
			</table>
			<table class="toc_tbl">
				<tr>
					<td width="70%" style="font-size: 14px;font-weight: bold;">Sales Aptitude Indicator (SAI) *</td>
					<?php
					if($sales_aptitude_score == 1){
						echo '<td width="20%" align="right" style="color:red">Extremely Low</td><td width="10%" align="center" style="color:red">1</td>';
					}
					else if($sales_aptitude_score == 2){
						echo '<td width="20%" align="right" style="color:red">Very Low</td><td width="10%" align="center" style="color:red">2</td>';
					}
					else if($sales_aptitude_score == 3){
						echo '<td width="20%" align="right" style="color:red">Low</td><td width="10%" align="center" style="color:red">3</td>';
					}
					else if($sales_aptitude_score == 4 || $sales_aptitude_score == 5 || $sales_aptitude_score == 6){
						echo '<td width="20%" align="right" style="color:#FDB813">Moderate</td><td width="10%" align="center" style="color:#FDB813">'.$sales_aptitude_score.'</td>';
					}
					else if($sales_aptitude_score == 7 || $sales_aptitude_score == 8){
						echo '<td width="20%" align="right" style="color:green">High</td><td width="10%" align="center" style="color:green">'.$sales_aptitude_score.'</td>';
					}
					else if($sales_aptitude_score == 9){
						echo '<td width="20%" align="right" style="color:green">Very High</td><td width="10%" align="center" style="color:green">9</td>';
					}
					else if($sales_aptitude_score == 10){
						echo '<td width="20%" align="right" style="color:green">Very High</td><td width="10%" align="center" style="color:green">10</td>';
					}

					?>
					
				</tr>
				<tr>
					<td colspan="3" style="font-size: 14px;font-style: italic;"><br>The SAI gives an indication of the candidates’ sales skills and knowledge<br></td>
				</tr>

				<tr>
					<td width="70%" style="font-size: 14px;font-weight: bold;">Sales Motivational Drivers (SMD) **</td>
					<?php
					if($smd_score == 1){
						echo '<td width="20%" align="right" style="color:red">Extremely Low</td><td width="10%" align="center" style="color:red">1</td>';
					}
					else if($smd_score == 2){
						echo '<td width="20%" align="right" style="color:red">Very Low</td><td width="10%" align="center" style="color:red">2</td>';
					}
					else if($smd_score == 3){
						echo '<td width="20%" align="right" style="color:red">Low</td><td width="10%" align="center" style="color:red">3</td>';
					}
					else if($smd_score == 4 || $smd_score == 5 || $smd_score == 6){
						echo '<td width="20%" align="right" style="color:#FDB813">Moderate</td><td width="10%" align="center" style="color:#FDB813">'.$smd_score.'</td>';
					}
					else if($smd_score == 7 || $smd_score == 8){
						echo '<td width="20%" align="right" style="color:green">High</td><td width="10%" align="center" style="color:green">'.$smd_score.'</td>';
					}
					else if($smd_score == 9){
						echo '<td width="20%" align="right" style="color:green">Very High</td><td width="10%" align="center" style="color:green">9</td>';
					}
					else if($smd_score == 10){
						echo '<td width="20%" align="right" style="color:green">Very High</td><td width="10%" align="center" style="color:green">10</td>';
					}
					?>
				</tr>
				<tr>
					<td colspan="3" style="font-size: 14px;font-style: italic;"><br>The SMD gives an indication of the candidates’ sales motivational drivers<br></td>
				</tr>

				<tr>
					<td width="70%" style="font-size: 14px;font-weight: bold;">Learning Speed Indicator (LSI) ***</td>
					<?php
					if($lsi <= 1){
						echo '<td width="20%" align="right" style="color:red">Extremely Low</td><td width="10%" align="center" style="color:red">1</td>';
					}
					else if($lsi == 2){
						echo '<td width="20%" align="right" style="color:red">Very Low</td><td width="10%" align="center" style="color:red">2</td>';
					}
					else if($lsi == 3){
						echo '<td width="20%" align="right" style="color:red">Low</td><td width="10%" align="center" style="color:red">3</td>';
					}
					else if($lsi == 4 || $lsi == 5 || $lsi == 6){
						echo '<td width="20%" align="right" style="color:#FDB813">Moderate</td><td width="10%" align="center" style="color:#FDB813">'.$lsi.'</td>';
					}
					else if($lsi == 7 || $lsi == 8){
						echo '<td width="20%" align="right" style="color:green">High</td><td width="10%" align="center" style="color:green">'.$lsi.'</td>';
					}
					else if($lsi == 9){
						echo '<td width="20%" align="right" style="color:green">Very High</td><td width="10%" align="center" style="color:green">9</td>';
					}
					else if($lsi == 10){
						echo '<td width="20%" align="right" style="color:green">Very High</td><td width="10%" align="center" style="color:green">10</td>';
					}
					?>
				</tr>

				<tr>
					<td colspan="3" style="font-size: 14px;font-style: italic;"><br>The LSI gives an indication of the candidates’ learning speed, i.e. how fast they can learn new
			information. <br></td>
				</tr>

				<tr>
					<td width="70%" style="font-size: 14px;font-weight: bold;">Behavioural Competency Attributes (BCA) ***</td>
					<?php
					if($secAB_score == 1 || $secAB_score == 0 || $secAB_score == -1 || $secAB_score == -2){
						echo '<td width="20%" align="right" style="color:#FDB813">Moderate</td><td width="10%" align="center" style="color:#FDB813">'.$secAB_score.'</td>';
					}
					else if($secAB_score == -3){
						echo '<td width="20%" align="right" style="color:red">Low</td><td width="10%" align="center" style="color:red">'.$secAB_score.'</td>';
					}
					else if($secAB_score == -4){
						echo '<td width="20%" align="right" style="color:red">Very Low</td><td width="10%" align="center" style="color:red">'.$secAB_score.'</td>';
					}
					else if($secAB_score == -5){
						echo '<td width="20%" align="right" style="color:red">Extremely Low</td><td width="10%" align="center" style="color:red">'.$secAB_score.'</td>';
					}
					else if($secAB_score == 2 || $secAB_score == 3){
						echo '<td width="20%" align="right" style="color:green">High</td><td width="10%" align="center" style="color:green">'.$secAB_score.'</td>';
					}
					else if($secAB_score == 4){
						echo '<td width="20%" align="right" style="color:green">Very High</td><td width="10%" align="center" style="color:green">9</td>';
					}
					else if($secAB_score == 5){
						echo '<td width="20%" align="right" style="color:green">Extremely High</td><td width="10%" align="center" style="color:green">10</td>';
					}
					?>
				</tr>

				<tr>
					<td colspan="3" style="font-size: 14px;font-style: italic;"><br>The LSI gives an indication of the candidates’ learning speed, i.e. how fast they can learn new information. <br></td>
				</tr>

				<tr>
					<td width="70%" style="font-size: 14px;font-weight: bold;">SALES PREDICTION INDICATOR (SPI) ****</td>
					<?php
					if($lsi <= 1){
						echo '<td width="20%" align="right" style="color:red">Extremely Low</td><td width="10%" align="center" style="color:red">1</td>';
					}
					else if($lsi == 2){
						echo '<td width="20%" align="right" style="color:red">Very Low</td><td width="10%" align="center" style="color:red">2</td>';
					}
					else if($lsi == 3){
						echo '<td width="20%" align="right" style="color:red">Low</td><td width="10%" align="center" style="color:red">3</td>';
					}
					else if($lsi == 4 || $lsi == 5 || $lsi == 6){
						echo '<td width="20%" align="right" style="color:#FDB813">Moderate</td><td width="10%" align="center" style="color:#FDB813">'.$lsi.'</td>';
					}
					else if($lsi == 7 || $lsi == 8){
						echo '<td width="20%" align="right" style="color:green">High</td><td width="10%" align="center" style="color:green">'.$lsi.'</td>';
					}
					else if($lsi == 9){
						echo '<td width="20%" align="right" style="color:green">Very High</td><td width="10%" align="center" style="color:green">9</td>';
					}
					else if($lsi == 10){
						echo '<td width="20%" align="right" style="color:green">Very High</td><td width="10%" align="center" style="color:green">10</td>';
					}
					?>
				</tr>
			</table>
			<br pagebreak="true"/>
		</div>

		<!-- PAGE 4 -->
		<div style="font-size:18px;padding-top:10px;color:white"><b>SALES POTENTIAL</b></div>
		<div class="tips">
			<p>This section provides an in-depth analysis of the candidates’ sales aptitude and motivational
			drivers.</p>
			<table>
				<tr>
					<td>
						<p class="body1"><b style="color:#518FF7">SALES APTITUDE</b><br><br>
						The Sales Aptitude section measured the candidates’ skills and knowledge on various sales related questions.<br></p>
					</td>
				</tr>
			</table>
			<table class="toc_tbl">
				<tr>
					<td width="70%" style="font-size: 14px;">Total correct answers</td>
					<td width="20%" align="center"></td>
					<td width="10%" align="center"><?php echo $total_correct_ans;?></td>
				</tr>
				<tr><td colspan="3"></td></tr>
				<tr>
					<td width="70%" style="font-size: 14px;">Sales Aptitude Indicator</td>
					<?php
					if($sales_aptitude_score == 1){
						echo '<td width="20%" align="right" style="color:red">Extremely Low</td><td width="10%" align="center" style="color:red">1</td>';
					}
					else if($sales_aptitude_score == 2){
						echo '<td width="20%" align="right" style="color:red">Very Low</td><td width="10%" align="center" style="color:red">2</td>';
					}
					else if($sales_aptitude_score == 3){
						echo '<td width="20%" align="right" style="color:red">Low</td><td width="10%" align="center" style="color:red">3</td>';
					}
					else if($sales_aptitude_score == 4 || $sales_aptitude_score == 5 || $sales_aptitude_score == 6){
						echo '<td width="20%" align="right" style="color:#FDB813">Moderate</td><td width="10%" align="center" style="color:#FDB813">'.$sales_aptitude_score.'</td>';
					}
					else if($sales_aptitude_score == 7 || $sales_aptitude_score == 8){
						echo '<td width="20%" align="right" style="color:green">High</td><td width="10%" align="center" style="color:green">'.$sales_aptitude_score.'</td>';
					}
					else if($sales_aptitude_score == 9){
						echo '<td width="20%" align="right" style="color:green">Very High</td><td width="10%" align="center" style="color:green">9</td>';
					}
					else if($sales_aptitude_score == 10){
						echo '<td width="20%" align="right" style="color:green">Very High</td><td width="10%" align="center" style="color:green">10</td>';
					}
					?>
				</tr>
			</table>
			<br>
			<br>
			<table>
				<tr>
					<td>
						<p class="body1"><b style="color:#518FF7">SALES BEHAVIOURAL COMPETENCIES</b><br><br>
						The Sales Behavioural Competencies lists the candidate’s five highest five lowest behavioural competencies.<br></p>
					</td>
				</tr>
			</table>
			<table class="toc_tbl" cellpadding="15" style="border: 1px solid #ddd">
				<tr>
					<th style="width: 50%;background-color: rgb(95, 99, 104);color: #FFF">Five Highest Behavioural Competencies </th>
					<th style="width: 50%;background-color: rgb(192, 0, 0);color: #FFF">Five Lowest Behavioural Competencies</th>
				</tr>
				<?php
				$i = 0;
				foreach ($mostCorelation as $key => $value) {
					if($i%2==0){
						?><tr>
							<td style="width: 50%;background-color: #f5f5f5;border-right: 1px solid #DDD"><?php echo $value;?></td>
							<td style="width: 50%;background-color: #f5f5f5;"><?php echo $leastCorelation[$key];?></td>
						</tr>
						<?php
					}else{
						?><tr><td style="width: 50%;border-right: 1px solid #DDD"><?php echo $value;?></td><td style="width: 50%"><?php echo $leastCorelation[$key];?></td></tr>
						<?php
					}
					$i++;
				}
				?>
			</table>

			<br pagebreak="true"/>
			<table>
				<tr>
					<td><br>
						<p class="body1">
						<b style="color:#518FF7">SALES MOTIVATIONAL DRIVERS</b><br><br>
						The Sales Motivational Drivers describes the candidates’ preferred motivational drivers in the working environment and how it relates to sales specific roles.<br></p>
					</td>
				</tr>
			</table>
	
			<?php
			echo '<img src="'.$file_path.'" style="width:600px; height:600px;" />'
			?>

			<br pagebreak="true"/>
		</div>

		<!-- PAGE 5 -->
		<div style="font-size:18px;padding-top:10px;color:white"><b>DEFINITIONS OF MOTIVATIONAL DRIVERS</b></div>
		<div class="tips">
			<br>
			<br>
			<br>
			<table class="toc_tbl" cellpadding="4" cellspacing="1">
				<tr>
					<td width="40%" style="font-size:12px;border-right: 0px solid black;font-weight: bold;background-color: #f5f5f5;">COACHABLE</td>
					<td width="60%" style="background-color: #f5f5f5;">Enjoys learning new information and seeking advice from others. </td>
				</tr>
				<tr>
					<td width="40%" style="font-size:12px;border-right: 0px solid black;font-weight: bold;;">CURIOSITY</td>
					<td width="60%">Always want to know how things work, question the status quo, and being very open-minded</td>
				</tr>

				<tr>
					<td width="40%" style="font-size:12px;border-right: 0px solid black;font-weight: bold;background-color: #f5f5f5">PRIOR SUCCESS</td>
					<td width="60%" style="background-color: #f5f5f5">Having a history of success in sales, and being driven to achieve</td>
				</tr>
				<tr>
					<td width="40%" style="font-size:12px;border-right: 0px solid black;font-weight: bold;;">WORK ETHIC</td>
					<td width="60%">Will always try and protect the brand, not afraid to work long hours, and being very energetic at work</td>
				</tr>

				<tr>
					<td width="40%" style="font-size:12px;border-right: 0px solid black;font-weight: bold;background-color: #f5f5f5">PASSION</td>
					<td width="60%" style="background-color: #f5f5f5">Being passionate about selling, living the brand and being engaged in their jobs.</td>
				</tr>
				<tr>
					<td width="40%" style="font-size:12px;border-right: 0px solid black;font-weight: bold;;">ENTREPRENEURIAL INSTINCT</td>
					<td width="60%">Likes coming up with creative and innovative ways to sell, interested in running own business.</td>
				</tr>

				<tr>
					<td width="40%" style="font-size:12px;border-right: 0px solid black;font-weight: bold;background-color: #f5f5f5">CONFIDENCE</td>
					<td width="60%" style="background-color: #f5f5f5">Having the confidence in their own abilities to sell, believes they have the right skills to be a good at sales</td>
				</tr>
				<tr>
					<td width="40%" style="font-size:12px;border-right: 0px solid black;font-weight: bold;;">ENTHUSIASM</td>
					<td width="60%">Being excited about the future, enjoys meeting new people, and love being at work</td>
				</tr>

				<tr>
					<td width="40%" style="font-size:12px;border-right: 0px solid black;font-weight: bold;background-color: #f5f5f5">RESOURCEFULNESS</td>
					<td width="60%" style="background-color: #f5f5f5">Knows where to find more/new information, enjoys reading up on things</td>
				</tr>
				<tr>
					<td width="40%" style="font-size:12px;border-right: 0px solid black;font-weight: bold;;">TRUSTWORTHY</td>
					<td width="60%">Always delivering on promises, following rules of the company, and easily trust others</td>
				</tr>

				<tr>
					<td width="40%" style="font-size:12px;border-right: 0px solid black;font-weight: bold;background-color: #f5f5f5">PRODUCT KNOWLEDGE</td>
					<td width="60%" style="background-color: #f5f5f5">Enjoys learning something new about the product they sell, they read often to learn more about the product</td>
				</tr>
				<tr>
					<td width="40%" style="font-size:12px;border-right: 0px solid black;font-weight: bold;;">FUN</td>
					<td width="60%">Likes to laugh and have fun at work, enjoys working in teams that work well together</td>
				</tr>

				<tr>
					<td width="40%" style="font-size:12px;border-right: 0px solid black;font-weight: bold;background-color: #f5f5f5">INITIATIVE</td>
					<td width="60%" style="background-color: #f5f5f5">Takes own initiative to get things done, taking the lead to get things going</td>
				</tr>
				<tr>
					<td width="40%" style="font-size:12px;border-right: 0px solid black;font-weight: bold;;">DEALING WITH CONFLICT</td>
					<td width="60%">Being good at resolving conflict, comfortable dealing with people who are upset and find a solution</td>
				</tr>

				<tr>
					<td width="40%" style="font-size:12px;border-right: 0px solid black;font-weight: bold;background-color: #f5f5f5">FINANCIAL REWARD</td>
					<td width="60%" style="background-color: #f5f5f5">Enjoys making money and earning high commissions, care more about money than prestige</td>
				</tr>
				<tr>
					<td width="40%" style="font-size:12px;border-right: 0px solid black;font-weight: bold;;">SECURITY</td>
					<td width="60%">Wants to feel safe, needs predictability and clearly defined job outcomes at work</td>
				</tr>
				<tr>
					<td width="40%" style="font-size:12px;border-right: 0px solid black;font-weight: bold;background-color: #f5f5f5">FLEXIBILITY</td>
					<td width="60%" style="background-color: #f5f5f5">Being spontaneous, like working in environments with little or no routine and/or structure.</td>
				</tr>
			</table>

			<br pagebreak="true"/>
		</div>

		<!-- PAGE 6 -->
		<div style="font-size:18px;padding-top:10px;color:white"><b>LEARNING POTENTIAL</b></div>
		<div class="tips">
			<p>The Learning Speed assessment measures candidates’ potential to learn new information in a variety of formats and settings. Candidates with a higher learning speed can think on their feet, and respond quicker to new information or problems, and finding solutions quicker. </p>
			<br>
			<table class="toc_tbl" cellpadding="3">
				<tr>
					<td width="70%" style="font-size: 15px;" colspan="3"><b style="color:#518FF7">Result</b></td>
				</tr>
				<tr><td colspan="3"></td></tr>
				<tr>
					<td width="70%" style="font-size: 14px;">Reasoning</td>
					<?php
					if($LAP_S_A_result == 1){
						echo '<td width="20%" align="right" style="color:red">Extremely Low</td><td width="10%" align="center" style="color:red">1</td>';
					}
					else if($LAP_S_A_result == 2){
						echo '<td width="20%" align="right" style="color:red">Very Low</td><td width="10%" align="center" style="color:red">2</td>';
					}
					else if($LAP_S_A_result == 3 || $LAP_S_A_result == 0){
						echo '<td width="20%" align="right" style="color:red">Low</td><td width="10%" align="center" style="color:red">'.$LAP_S_A_result.'</td>';
					}
					else if($LAP_S_A_result == 4 || $LAP_S_A_result == 5 || $LAP_S_A_result == 6){
						echo '<td width="20%" align="right" style="color:#FDB813">Moderate</td><td width="10%" align="center" style="color:#FDB813">'.$LAP_S_A_result.'</td>';
					}
					else if($LAP_S_A_result == 7 || $LAP_S_A_result == 8){
						echo '<td width="20%" align="right" style="color:green">High</td><td width="10%" align="center" style="color:green">'.$LAP_S_A_result.'</td>';
					}
					else if($LAP_S_A_result == 9){
						echo '<td width="20%" align="right" style="color:green">Very High</td><td width="10%" align="center" style="color:green">9</td>';
					}
					else if($LAP_S_A_result == 10){
						echo '<td width="20%" align="right" style="color:green">Very High</td><td width="10%" align="center" style="color:green">10</td>';
					}
					?>
				</tr>
				<tr><td colspan="3"></td></tr>
				<tr>
					<td width="70%" style="font-size: 14px;">Memory</td>
					<?php
					if($LAP_S_B_result == 1){
						echo '<td width="20%" align="right" style="color:red">Extremely Low</td><td width="10%" align="center" style="color:red">1</td>';
					}
					else if($LAP_S_B_result == 2){
						echo '<td width="20%" align="right" style="color:red">Very Low</td><td width="10%" align="center" style="color:red">2</td>';
					}
					else if($LAP_S_B_result == 3 || $LAP_S_B_result == 0){
						echo '<td width="20%" align="right" style="color:red">Low</td><td width="10%" align="center" style="color:red">'.$LAP_S_B_result.'</td>';
					}
					else if($LAP_S_B_result == 4 || $LAP_S_B_result == 5 || $LAP_S_B_result == 6){
						echo '<td width="20%" align="right" style="color:#FDB813">Moderate</td><td width="10%" align="center" style="color:#FDB813">'.$LAP_S_B_result.'</td>';
					}
					else if($LAP_S_B_result == 7 || $LAP_S_B_result == 8){
						echo '<td width="20%" align="right" style="color:green">High</td><td width="10%" align="center" style="color:green">'.$LAP_S_B_result.'</td>';
					}
					else if($LAP_S_B_result == 9){
						echo '<td width="20%" align="right" style="color:green">Very High</td><td width="10%" align="center" style="color:green">9</td>';
					}
					else if($LAP_S_B_result == 10){
						echo '<td width="20%" align="right" style="color:green">Very High</td><td width="10%" align="center" style="color:green">10</td>';
					}
					?>
				</tr>
				<tr><td colspan="3"></td></tr>
				<tr>
					<td width="70%" style="font-size: 14px;">Numerical</td>
					<?php
					if($LAP_S_C_result == 1){
						echo '<td width="20%" align="right" style="color:red">Extremely Low</td><td width="10%" align="center" style="color:red">1</td>';
					}
					else if($LAP_S_C_result == 2){
						echo '<td width="20%" align="right" style="color:red">Very Low</td><td width="10%" align="center" style="color:red">2</td>';
					}
					else if($LAP_S_C_result == 3 || $LAP_S_C_result == 0){
						echo '<td width="20%" align="right" style="color:red">Low</td><td width="10%" align="center" style="color:red">'.$LAP_S_C_result.'</td>';
					}
					else if($LAP_S_C_result == 4 || $LAP_S_C_result == 5 || $LAP_S_C_result == 6){
						echo '<td width="20%" align="right" style="color:#FDB813">Moderate</td><td width="10%" align="center" style="color:#FDB813">'.$LAP_S_C_result.'</td>';
					}
					else if($LAP_S_C_result == 7 || $LAP_S_C_result == 8){
						echo '<td width="20%" align="right" style="color:green">High</td><td width="10%" align="center" style="color:green">'.$LAP_S_C_result.'</td>';
					}
					else if($LAP_S_C_result == 9){
						echo '<td width="20%" align="right" style="color:green">Very High</td><td width="10%" align="center" style="color:green">9</td>';
					}
					else if($LAP_S_C_result == 10){
						echo '<td width="20%" align="right" style="color:green">Very High</td><td width="10%" align="center" style="color:green">10</td>';
					}
					?>
				</tr>
				<tr><td colspan="3"></td></tr>
				<tr>
					<td width="70%" style="font-size: 14px;">Spatial</td>
					<?php
					if($LAP_S_D_result == 1){
						echo '<td width="20%" align="right" style="color:red">Extremely Low</td><td width="10%" align="center" style="color:red">1</td>';
					}
					else if($LAP_S_D_result == 2){
						echo '<td width="20%" align="right" style="color:red">Very Low</td><td width="10%" align="center" style="color:red">2</td>';
					}
					else if($LAP_S_D_result == 3 || $LAP_S_D_result == 0){
						echo '<td width="20%" align="right" style="color:red">Low</td><td width="10%" align="center" style="color:red">'.$LAP_S_D_result.'</td>';
					}
					else if($LAP_S_D_result == 4 || $LAP_S_D_result == 5 || $LAP_S_D_result == 6){
						echo '<td width="20%" align="right" style="color:#FDB813">Moderate</td><td width="10%" align="center" style="color:#FDB813">'.$LAP_S_D_result.'</td>';
					}
					else if($LAP_S_D_result == 7 || $LAP_S_D_result == 8){
						echo '<td width="20%" align="right" style="color:green">High</td><td width="10%" align="center" style="color:green">'.$LAP_S_D_result.'</td>';
					}
					else if($LAP_S_D_result == 9){
						echo '<td width="20%" align="right" style="color:green">Very High</td><td width="10%" align="center" style="color:green">9</td>';
					}
					else if($LAP_S_D_result == 10){
						echo '<td width="20%" align="right" style="color:green">Very High</td><td width="10%" align="center" style="color:green">10</td>';
					}
					?>
				</tr>

				<tr><td colspan="3"></td></tr>
				<tr>
					<td width="70%" style="font-size: 14px;"><b>LEARNING SPEED INDEX</b></td>
					<?php
					if($learning_speed_index <= 1){
						echo '<td width="20%" align="right" style="color:red">Extremely Low</td><td width="10%" align="center" style="color:red">1</td>';
					}
					else if($learning_speed_index == 2){
						echo '<td width="20%" align="right" style="color:red">Very Low</td><td width="10%" align="center" style="color:red">2</td>';
					}
					else if($learning_speed_index == 3){
						echo '<td width="20%" align="right" style="color:red">Low</td><td width="10%" align="center" style="color:red">3</td>';
					}
					else if($learning_speed_index == 4 || $learning_speed_index == 5 || $learning_speed_index == 6){
						echo '<td width="20%" align="right" style="color:#FDB813">Moderate</td><td width="10%" align="center" style="color:#FDB813">'.$learning_speed_index.'</td>';
					}
					else if($learning_speed_index == 7 || $learning_speed_index == 8){
						echo '<td width="20%" align="right" style="color:green">High</td><td width="10%" align="center" style="color:green">'.$learning_speed_index.'</td>';
					}
					else if($learning_speed_index == 9){
						echo '<td width="20%" align="right" style="color:green">Very High</td><td width="10%" align="center" style="color:green">9</td>';
					}
					else if($learning_speed_index == 10){
						echo '<td width="20%" align="right" style="color:green">Very High</td><td width="10%" align="center" style="color:green">10</td>';
					}
					?>
				</tr>
			</table>

			<p><br></p>
			<table class="toc_tbl" cellpadding="3">
				<tr>
					<td style="font-size: 16px;" colspan="3"><b style="color:#518FF7">DEFINITIONS AND INTERPRETATIONS</b><br></td>
				</tr>
				<tr>
					<td width="22%" valign="middle" align="center" style="vertical-align: middle;border-right:1px solid black;vertical-align: middle;font-size: 14px;font-weight:bold;background-color: #f5f5f5">Reasoning</td>
					<td width="3%" style="background-color: #f5f5f5"></td>
					<td width="75%" style="background-color: #f5f5f5">The ability to accurately interpret and analyse new information and draw accurate conclusions. Candidates with a high reasoning potential may be good at interpreting information from a potential client and link the product/service they sell to the solution.</td>
				</tr>
				<tr>
					<td width="22%" valign="middle" align="center" style="vertical-align: middle;border-right:1px solid black;vertical-align: middle;font-size: 14px;font-weight:bold;">Memory</td>
					<td width="3%"></td>
					<td width="75%">The ability to accurately recall information. Candidates with a high memory score may be good at remembering key points/requests a potential client mentioned earlier, and also important information regarding the product/service they sell.</td>
				</tr>
				<tr>
					<td width="22%" valign="middle" align="center" style="vertical-align: middle;border-right:1px solid black;vertical-align: middle;font-size: 14px;font-weight:bold;background-color: #f5f5f5">Numerical</td>
					<td width="3%" style="background-color: #f5f5f5"></td>
					<td width="75%" style="background-color: #f5f5f5">The ability to accurately perform basic calculations. Candidates with a high numerical potential may be good at performing quick calculations like monthly repayment costs, discount fees, cost savings etc relating to the product/service they sell.</td>
				</tr>
				<tr>
					<td width="22%" valign="middle" align="center" style="vertical-align: middle;border-right:1px solid black;vertical-align: middle;font-size: 14px;font-weight:bold;">Spatial</td>
					<td width="3%"></td>
					<td width="75%">The ability to visualise shapes and patterns. Candidates with a high spatial reasoning potential may visualise creative or original ways of using a product in the selling process, which may increase the potential sale of a product/service</td>
				</tr>
			</table>

			<br pagebreak="true"/>
		</div>

		<!-- PAGE 7 -->
		<div style="font-size:18px;padding-top:10px;color:white"><b>COMPETENCY-BASED SALES INTERVIEW</b></div>
		<div class="tips">
			<p>This section provides the candidates’ answers from five competency-based interview questions they were asked to respond to during this assessment. It is recommended that answers are explored during final interviews and candidates are asked to elaborate on their answers. <br><br>Candidates only had 100 words or less to answer each question. Responses are reported verbatim.</p>
			<br>
			
			<?php
			// $openTextArr = array("1"=>"How do you keep up to date on your target market?","2"=>"How much time did you spend cultivating customer relationships versus hunting for new clients, and why?","3"=>"What role does social media play in your selling process?","4"=>"How does your current employer bring value to the customer?","5"=>"What are three important qualifying questions you ask every prospect?","6"=>"Describe a time when you had a difficult prospect, and how you handled that situation to win the sale.","7"=>"What's the best way to establish a relationship with a prospect?","8"=>"Explain the steps you take, from the beginning of the sales process to the end.","9"=>"What's worse: Not making quota every single month or not having happy customers?","10"=>"What's your least favourite part of the sales process?","11"=>"What are three adjectives a former client would use to describe you?","12"=>"What core values should every salesperson possess?");
			$interviewQuestion = array(
			    '1'=> 'How do you keep up to date on your target market?',
			    '2'=> 'How much time did you spend cultivating customer relationships versus hunting for new clients, and why?',
			    '3'=> 'What role does social media play in your selling process?',
			    '4'=> 'How does your current employer bring value to the customer?',
			    '5'=> 'What are three important qualifying questions you ask every prospect?',
			    '6'=> 'Describe a time when you had a difficult prospect, and how you handled that situation to win the sale?',
			);


			//echo '<pre>';
			ksort($openTextRes);
			//print_r($openTextRes);
			$i = 0;
			foreach ($interviewQuestion as $key => $value) {

				if(isset($openTextRes[$key])){
					?>
					<p><strong style="color:#518FF7"><?php echo $value;?></strong></p>
					<table cellpadding="5">
						<tr>
							<td style="height: 150px;border:1px solid black"><?php echo $openTextRes[$key];?></td>
						</tr>
					</table>
					<p><br></p>
					<?php
				}else{
				?>
					<p><strong style="color:#518FF7"><?php echo $value;?></strong></p>
					<table cellpadding="5">
						<tr>
							<td style="height: 150px;border:1px solid black">--</td>
						</tr>
					</table>
					<p><br></p>
				<?php
				}
			}
			?>

			<br pagebreak="true"/>
		</div>


		<!-- FOOTER -->
		<div style="font-size:18px;color:white"><b>DISCLAIMER</b></div>
		<div class="disclosure">
			<p><strong style="color:#518FF7">Purpose:</strong> The purpose of this report is to indicate the test-taker’s results on various sales related attributes and learning potential. This report is for the attention of the manager who requested the test and remains the property of Strategic Talent Technologies. Thisreport may not be shared with any individual or company without the written consent from the candidate whose name is on the front of this report.</p>
			<p><strong style="color:#518FF7">Disclaimer:</strong> Since the report contains confidential information, it needs to be dealt with accordingly. Consequently, this report may not be given to the candidate in any form. It may also not be used as evidence in a disciplinary hearing. Should this report or the content of the report be handled or communicated incorrectly by any party within the company, Strategic Talent Technologies cannot be held liable for any claims resulting from such action.</p>
		</div>



	</div>
</div>

