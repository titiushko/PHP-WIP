<?php
header("Content-type: application/vnd.ms-word");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Content-Disposition: attachment; filename=EXPORTAR-WORD.doc");
?>
<HTML>
	<HEAD>
		<TITLE>EJEMPLO EXPORTACION EN PHP</TITLE>
	</HEAD>
	<BODY>
		<TABLE ALIGN="CENTER">
			<TR>
				<TD ALIGN="CENTER">
					<TABLE BORDER="1">
						<THEAD>
							<TR>
								<TH WIDTH="10%"><H3>INICIO</H3></TH>
								<TH WIDTH="10%"><H3>CANTIDA</H3></TH>
								<TH WIDTH="10%"><H3>FIN</H3></TH>
								<TH WIDTH="10%"><H3>CANTIDAD QUE CONTINUARON</H3></TH>
							</TR>
						</THEAD>
						<TBODY ALIGN="CENTER">
							<TR>
								<TD ALIGN="CENTER">2000</TD>
								<TD ALIGN="CENTER">5</TD>
								<TD ALIGN="CENTER">2001</TD>
								<TD ALIGN="CENTER">3</TD>
							</TR>
							<TR>
								<TD ALIGN="CENTER">2001</TD>
								<TD ALIGN="CENTER">7</TD>
								<TD ALIGN="CENTER">2002</TD>
								<TD ALIGN="CENTER">4</TD>
							</TR>
							<TR>
								<TD ALIGN="CENTER">2002</TD>
								<TD ALIGN="CENTER">8</TD>
								<TD ALIGN="CENTER">2003</TD>
								<TD ALIGN="CENTER">5</TD>
							</TR>
							<TR>
								<TD ALIGN="CENTER">2003</TD>
								<TD ALIGN="CENTER">4</TD>
								<TD ALIGN="CENTER">2004</TD>
								<TD ALIGN="CENTER">3</TD>
							</TR>
							<TR>
								<TD ALIGN="CENTER">2004</TD>
								<TD ALIGN="CENTER">7</TD>
								<TD ALIGN="CENTER">2005</TD>
								<TD ALIGN="CENTER">3</TD>
							</TR>
						</TBODY>
					</TABLE>
				</TD>
			</TR>
		</TABLE>
	</BODY>
</HTML>