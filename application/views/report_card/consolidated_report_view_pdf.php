<table style="width:100%">
	<tr>
		<td>
			<center><img src="assets/school_logo/cbse_logo.jpg" style="margin-left:5%; width:83px;"></center>
		</td>
		<td>
			<center>
				<h1><span style="color:#02933e">JAWAHAR VIDYA MANDIR</span></h1>DORANDA, RANCHI - 834 002 (JHARKHAND)<br />Consolidated Report <?php echo $CLASS_NM . '-' . $SECTION_NAME; ?>
			</center>
		</td>
		<td>
			<center><img src="assets/school_logo/1560227769.png" style="margin-left:5%; width:83px;"></center>
		</td>
	</tr>
</table>
<table style='font-size:11px; white-space: nowrap !important; width:85% !important' border='1' cellspacing='0'>
	<thead>
		<tr>
			<td rowspan='2' align="center" valign="middle" style="width: 3%;">Sl.No</td>
			<td rowspan='2' align="left" valign="middle" style="width: 5%;">Adm.No</td>
			<td rowspan='2' align="left" style="width: 10%;">Stu.Name</td>
			<td rowspan='2' align="center" style="width: 5%;">TERM</td>


			<th colspan="4" align="center" valign="middle" scope="col">
				<center>ENGLISH</center>
			</th>
			<th colspan="4" align="center" valign="middle" scope="col">
				<center>HINDI</center>
			</th>
			<th colspan="4" align="center" valign="middle" scope="col">
				<center>MATH</center>
			</th>
			<th colspan="4" align="center" valign="middle" scope="col">
				<center>SCIENCE</center>
			</th>
			<th colspan="4" align="center" valign="middle" scope="col">
				<center>SOCIAL SCIENCE</center>
			</th>
			<th colspan="4" align="center" valign="middle" scope="col">
				<center>SANSKRIT</center>
			</th>
			<th colspan="4" align="center" valign="middle" scope="col">
				<center>G.K</center>
			</th>
			<th colspan="4" align="center" valign="middle" scope="col">
				<center>I.T</center>
			</th>
		</tr>
		<tr><?php for($i=1;$i<=8;$i++){?>
			<th ><center>&nbsp;&nbsp;&nbsp;PT.&nbsp;&nbsp;&nbsp;</center></th>
			<th><center>TERM</center></th>
			<th><center>CONS.</center></th>
			<th><center>GRADE</center></th>
		<?php } ?>
		</tr>

	</thead>
	<tbody>
		<?php
		$i = 1;
		foreach ($student_data as $p) {

		?>

			<tr>
				<td rowspan="3" align="center"><?php echo $i; ?></td>
				<td rowspan="3">&nbsp;<?php echo $p->ADM_NO; ?></td>
				<td rowspan="3">&nbsp;<?php echo $p->FIRST_NM; ?></td>
				<td align='center'>TERM-I</td>

				<!-- ENGLISH -->
				<th>
					<center><?php echo $this->alam->get_consolidated_report('1', $p->ADM_NO, 10); ?></center>
				</th>
				<th>
					<center><?php echo $this->alam->get_consolidated_report('4', $p->ADM_NO, 10); ?></center>
				</th>
				<th>
					<center><?php echo ($this->alam->get_consolidated_report('1', $p->ADM_NO, 10) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 10)); ?></center>
				</th>
				<th>
					<center>
						<?php $g = ($this->alam->get_consolidated_report('1', $p->ADM_NO, 10) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 10));
						echo $this->alam->get_grade_consolidated($g);
						?>

					</center>
				</th>
				<!-- HINDI -->
				<th>
					<center><?php echo $this->alam->get_consolidated_report('1', $p->ADM_NO, 18); ?></center>
				</th>
				<th>
					<center><?php echo $this->alam->get_consolidated_report('4', $p->ADM_NO, 18); ?></center>
				</th>
				<th>
					<center><?php echo ($this->alam->get_consolidated_report('1', $p->ADM_NO, 18) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 18)); ?></center>
				</th>
				<th>
					<center>
						<?php $g = ($this->alam->get_consolidated_report('1', $p->ADM_NO, 18) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 18));
						echo $this->alam->get_grade_consolidated($g);
						?>

					</center>
				</th>
				<!-- MATH -->
				<th>
					<center><?php echo $this->alam->get_consolidated_report('1', $p->ADM_NO, 22); ?></center>
				</th>
				<th>
					<center><?php echo $this->alam->get_consolidated_report('4', $p->ADM_NO, 22); ?></center>
				</th>
				<th>
					<center><?php echo ($this->alam->get_consolidated_report('1', $p->ADM_NO, 22) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 22)); ?></center>
				</th>
				<th>
					<center>
						<?php $g = ($this->alam->get_consolidated_report('1', $p->ADM_NO, 22) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 22));
						echo $this->alam->get_grade_consolidated($g);
						?>

					</center>
				</th>
				<!-- SCI -->
				<th>
					<center><?php echo $this->alam->get_consolidated_report('1', $p->ADM_NO, 28); ?></center>
				</th>
				<th>
					<center><?php echo $this->alam->get_consolidated_report('4', $p->ADM_NO, 28); ?></center>
				</th>
				<th>
					<center><?php echo ($this->alam->get_consolidated_report('1', $p->ADM_NO, 28) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 28)); ?></center>
				</th>
				<th>
					<center>
						<?php $g = ($this->alam->get_consolidated_report('1', $p->ADM_NO, 28) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 28));
						echo $this->alam->get_grade_consolidated($g);
						?>

					</center>
				</th>
				<!-- S SCI -->
				<th>
					<center><?php echo $this->alam->get_consolidated_report('1', $p->ADM_NO, 26); ?></center>
				</th>
				<th>
					<center><?php echo $this->alam->get_consolidated_report('4', $p->ADM_NO, 26); ?></center>
				</th>
				<th>
					<center><?php echo ($this->alam->get_consolidated_report('1', $p->ADM_NO, 26) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 26)); ?></center>
				</th>
				<th>
					<center>
						<?php $g = ($this->alam->get_consolidated_report('1', $p->ADM_NO, 26) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 26));
						echo $this->alam->get_grade_consolidated($g);
						?>

					</center>
				</th>
				<!-- SANSKRIT -->
				<th>
					<center><?php echo $this->alam->get_consolidated_report('1', $p->ADM_NO, 27); ?></center>
				</th>
				<th>
					<center><?php echo $this->alam->get_consolidated_report('4', $p->ADM_NO, 27); ?></center>
				</th>
				<th>
					<center><?php echo ($this->alam->get_consolidated_report('1', $p->ADM_NO, 27) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 27)); ?></center>
				</th>
				<th>
					<center>
						<?php $g = ($this->alam->get_consolidated_report('1', $p->ADM_NO, 27) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 27));
						echo $this->alam->get_grade_consolidated($g);
						?>

					</center>
				</th>
				<!-- GK -->
				<th>
					<center><?php echo $this->alam->get_consolidated_report('1', $p->ADM_NO, 43); ?></center>
				</th>
				<th>
					<center><?php echo $this->alam->get_consolidated_report('4', $p->ADM_NO, 43); ?></center>
				</th>
				<th>
					<center><?php echo ($this->alam->get_consolidated_report('1', $p->ADM_NO, 43) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 43)); ?></center>
				</th>
				<th>
					<center>
						<?php $g = ($this->alam->get_consolidated_report('1', $p->ADM_NO, 43) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 43));
						echo $this->alam->get_grade_consolidated($g);
						?>

					</center>
				</th>
				<!-- IT -->
				<th>
					<center><?php echo $this->alam->get_consolidated_report('1', $p->ADM_NO, 7); ?></center>
				</th>
				<th>
					<center><?php echo $this->alam->get_consolidated_report('4', $p->ADM_NO, 7); ?></center>
				</th>
				<th>
					<center><?php echo ($this->alam->get_consolidated_report('1', $p->ADM_NO, 7) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 7)); ?></center>
				</th>
				<th>
					<center>
						<?php $g = ($this->alam->get_consolidated_report('1', $p->ADM_NO, 7) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 7));
						echo $this->alam->get_grade_consolidated($g);
						?>

					</center>
				</th>

			</tr>
			<tr>
				<td align='center'>TERM-II</td>
				<!-- ENGLISH -->
				<th>
					<center><?php echo $this->alam->get_consolidated_report('7', $p->ADM_NO, 10); ?> </center>
				</th>
				<th>
					<center><?php echo $this->alam->get_consolidated_report('5', $p->ADM_NO, 10); ?> </center>
				</th>
				<th>
					<center><?php echo ($this->alam->get_consolidated_report('7', $p->ADM_NO, 10) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 10)); ?></center>
				</th>
				<th>
					<center>
						<?php $g = ($this->alam->get_consolidated_report('7', $p->ADM_NO, 10) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 10));
						echo $this->alam->get_grade_consolidated($g);
						?>

					</center>
				</th>
				<!-- HINDI -->
				<th>
					<center><?php echo $this->alam->get_consolidated_report('7', $p->ADM_NO, 18); ?> </center>
				</th>
				<th>
					<center><?php echo $this->alam->get_consolidated_report('5', $p->ADM_NO, 18); ?> </center>
				</th>
				<th>
					<center><?php echo ($this->alam->get_consolidated_report('7', $p->ADM_NO, 18) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 18)); ?></center>
				</th>
				<th>
					<center>
						<?php $g = ($this->alam->get_consolidated_report('7', $p->ADM_NO, 18) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 18));
						echo $this->alam->get_grade_consolidated($g);
						?>

					</center>
				</th>
				<!-- MATH -->
				<th>
					<center><?php echo $this->alam->get_consolidated_report('7', $p->ADM_NO, 22); ?> </center>
				</th>
				<th>
					<center><?php echo $this->alam->get_consolidated_report('5', $p->ADM_NO, 22); ?> </center>
				</th>
				<th>
					<center><?php echo ($this->alam->get_consolidated_report('7', $p->ADM_NO, 22) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 22)); ?></center>
				</th>
				<th>
					<center>
						<?php $g = ($this->alam->get_consolidated_report('7', $p->ADM_NO, 22) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 22));
						echo $this->alam->get_grade_consolidated($g);
						?>

					</center>
				</th>
				<!-- SCI -->
				<th>
					<center><?php echo $this->alam->get_consolidated_report('7', $p->ADM_NO, 28); ?> </center>
				</th>
				<th>
					<center><?php echo $this->alam->get_consolidated_report('5', $p->ADM_NO, 28); ?> </center>
				</th>
				<th>
					<center><?php echo ($this->alam->get_consolidated_report('7', $p->ADM_NO, 28) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 28)); ?></center>
				</th>
				<th>
					<center>
						<?php $g = ($this->alam->get_consolidated_report('7', $p->ADM_NO, 28) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 28));
						echo $this->alam->get_grade_consolidated($g);
						?>

					</center>
				</th>
				<!-- S SCI -->
				<th>
					<center><?php echo $this->alam->get_consolidated_report('7', $p->ADM_NO, 26); ?> </center>
				</th>
				<th>
					<center><?php echo $this->alam->get_consolidated_report('5', $p->ADM_NO, 26); ?> </center>
				</th>
				<th>
					<center><?php echo ($this->alam->get_consolidated_report('7', $p->ADM_NO, 26) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 26)); ?></center>
				</th>
				<th>
					<center>
						<?php $g = ($this->alam->get_consolidated_report('7', $p->ADM_NO, 26) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 26));
						echo $this->alam->get_grade_consolidated($g);
						?>

					</center>
				</th>
				<!-- SANSKRIT -->
				<th>
					<center><?php echo $this->alam->get_consolidated_report('7', $p->ADM_NO, 27); ?> </center>
				</th>
				<th>
					<center><?php echo $this->alam->get_consolidated_report('5', $p->ADM_NO, 27); ?> </center>
				</th>
				<th>
					<center><?php echo ($this->alam->get_consolidated_report('7', $p->ADM_NO, 27) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 27)); ?></center>
				</th>
				<th>
					<center>
						<?php $g = ($this->alam->get_consolidated_report('7', $p->ADM_NO, 27) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 27));
						echo $this->alam->get_grade_consolidated($g);
						?>

					</center>
				</th>
				<!-- GK -->
				<th>
					<center><?php echo $this->alam->get_consolidated_report('7', $p->ADM_NO, 43); ?> </center>
				</th>
				<th>
					<center><?php echo $this->alam->get_consolidated_report('5', $p->ADM_NO, 43); ?> </center>
				</th>
				<th>
					<center><?php echo ($this->alam->get_consolidated_report('7', $p->ADM_NO, 43) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 43)); ?></center>
				</th>
				<th>
					<center>
						<?php $g = ($this->alam->get_consolidated_report('7', $p->ADM_NO, 43) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 43));
						echo $this->alam->get_grade_consolidated($g);
						?>

					</center>
				</th>
				<!-- IT -->
				<th>
					<center><?php echo $this->alam->get_consolidated_report('7', $p->ADM_NO, 7); ?> </center>
				</th>
				<th>
					<center><?php echo $this->alam->get_consolidated_report('5', $p->ADM_NO, 7); ?> </center>
				</th>
				<th>
					<center><?php echo ($this->alam->get_consolidated_report('7', $p->ADM_NO, 7) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 7)); ?></center>
				</th>
				<th>
					<center>
						<?php $g = ($this->alam->get_consolidated_report('7', $p->ADM_NO, 7) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 7));
						echo $this->alam->get_grade_consolidated($g);
						?>

					</center>
				</th>

			</tr>
			<tr>
				<td align='center'>CONS.</td>
				<!-- ENGLISH -->
				<th colspan="2">
					<center>
						<center><?php echo (($this->alam->get_consolidated_report('1', $p->ADM_NO, 10) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 10))
									+ ($this->alam->get_consolidated_report('7', $p->ADM_NO, 10) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 10))) / 2; ?></center>

					</center>
				</th>
				<th colspan="2">
					<center>
						<?php
						$g = (($this->alam->get_consolidated_report('1', $p->ADM_NO, 10) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 10))
							+ ($this->alam->get_consolidated_report('7', $p->ADM_NO, 10) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 10))) / 2;

						echo $this->alam->get_grade_consolidated($g);
						?>
					</center>
				</th>
				<!-- HINDI -->

				<th colspan="2">
					<center>
						<center><?php echo (($this->alam->get_consolidated_report('1', $p->ADM_NO, 18) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 18))
									+ ($this->alam->get_consolidated_report('7', $p->ADM_NO, 18) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 18))) / 2; ?></center>

					</center>
				</th>
				<th colspan="2">
					<center>
						<?php
						$g = (($this->alam->get_consolidated_report('1', $p->ADM_NO, 18) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 18))
							+ ($this->alam->get_consolidated_report('7', $p->ADM_NO, 18) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 18))) / 2;

						echo $this->alam->get_grade_consolidated($g);
						?>
					</center>
				</th>

				<!-- MATH -->
				<th colspan="2">
					<center>
						<center><?php echo (($this->alam->get_consolidated_report('1', $p->ADM_NO, 22) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 22))
									+ ($this->alam->get_consolidated_report('7', $p->ADM_NO, 22) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 22))) / 2; ?></center>

					</center>
				</th>
				<th colspan="2">
					<center>
						<?php
						$g = (($this->alam->get_consolidated_report('1', $p->ADM_NO, 22) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 22))
							+ ($this->alam->get_consolidated_report('7', $p->ADM_NO, 22) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 22))) / 2;

						echo $this->alam->get_grade_consolidated($g);
						?>
					</center>
				</th>
				<!-- SCI -->
				<th colspan="2">
					<center>
						<center><?php echo (($this->alam->get_consolidated_report('1', $p->ADM_NO, 28) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 28))
									+ ($this->alam->get_consolidated_report('7', $p->ADM_NO, 28) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 28))) / 2; ?></center>

					</center>
				</th>
				<th colspan="2">
					<center>
						<?php
						$g = (($this->alam->get_consolidated_report('1', $p->ADM_NO, 28) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 28))
							+ ($this->alam->get_consolidated_report('7', $p->ADM_NO, 28) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 28))) / 2;

						echo $this->alam->get_grade_consolidated($g);
						?>
					</center>
				</th>
				<!-- S SCI -->
				<th colspan="2">
					<center>
						<center><?php echo (($this->alam->get_consolidated_report('1', $p->ADM_NO, 26) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 26))
									+ ($this->alam->get_consolidated_report('7', $p->ADM_NO, 26) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 26))) / 2; ?></center>

					</center>
				</th>
				<th colspan="2">
					<center>
						<?php
						$g = (($this->alam->get_consolidated_report('1', $p->ADM_NO, 26) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 26))
							+ ($this->alam->get_consolidated_report('7', $p->ADM_NO, 26) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 26))) / 2;

						echo $this->alam->get_grade_consolidated($g);
						?>
					</center>
				</th>
				<!-- SANSKRIT -->
				<th colspan="2">
					<center>
						<center><?php echo (($this->alam->get_consolidated_report('1', $p->ADM_NO, 27) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 27))
									+ ($this->alam->get_consolidated_report('7', $p->ADM_NO, 27) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 27))) / 2; ?></center>

					</center>
				</th>
				<th colspan="2">
					<center>
						<?php
						$g = (($this->alam->get_consolidated_report('1', $p->ADM_NO, 27) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 27))
							+ ($this->alam->get_consolidated_report('7', $p->ADM_NO, 27) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 27))) / 2;

						echo $this->alam->get_grade_consolidated($g);
						?>
					</center>
				</th>
				<!-- GK -->
				<th colspan="2">
					<center>
						<center><?php echo (($this->alam->get_consolidated_report('1', $p->ADM_NO, 43) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 43))
									+ ($this->alam->get_consolidated_report('7', $p->ADM_NO, 43) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 43))) / 2; ?></center>

					</center>
				</th>
				<th colspan="2">
					<center>
						<?php
						$g = (($this->alam->get_consolidated_report('1', $p->ADM_NO, 43) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 43))
							+ ($this->alam->get_consolidated_report('7', $p->ADM_NO, 43) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 43))) / 2;

						echo $this->alam->get_grade_consolidated($g);
						?>
					</center>
				</th>
				<!-- IT -->
				<th colspan="2">
					<center>
						<center><?php echo (($this->alam->get_consolidated_report('1', $p->ADM_NO, 7) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 7))
									+ ($this->alam->get_consolidated_report('7', $p->ADM_NO, 7) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 7))) / 2; ?></center>

					</center>
				</th>
				<th colspan="2">
					<center>
						<?php
						$g = (($this->alam->get_consolidated_report('1', $p->ADM_NO, 7) + $this->alam->get_consolidated_report('4', $p->ADM_NO, 7))
							+ ($this->alam->get_consolidated_report('7', $p->ADM_NO, 7) + $this->alam->get_consolidated_report('5', $p->ADM_NO, 7))) / 2;

						echo $this->alam->get_grade_consolidated($g);
						?>
					</center>
				</th>
			</tr>


		<?php $i++;
		} ?>

	</tbody>
</table>