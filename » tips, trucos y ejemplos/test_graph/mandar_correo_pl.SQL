create or replace
PROCEDURE SP_SEND_EMAIL_ALARM AS 
 v_status_actual     VARCHAR2 (100);
 p_to                VARCHAR2 (100)    := 'jzepeda@miempresa.com';
 p_subject           VARCHAR2 (100)    := 'TESTING MI EMAIL';
 p_html              VARCHAR2 (100)      := '';
 p_smtp_hostname     VARCHAR2 (100)      := '168.243.10.66';
 p_smtp_portnum      VARCHAR2 (100)      := '25';
 p_sender            VARCHAR2 (100)      := 'dwarehouse@miempresa.com';
 c                   UTL_SMTP.connection;
 /*px_html             CLOB                := EMPTY_CLOB;
 px_html_tabla       CLOB                := EMPTY_CLOB;
 px_html_tds         CLOB                := EMPTY_CLOB;*/
 
 px_html             varchar2(4000) ;
 px_html_tabla       varchar2(4000) ;
 px_html_tds         varchar2(4000) ;
 
 v_registros         NUMBER;
 v_encabezado_html   varchar2(4000) 

    := '<html><head><meta><style type="text/css">

  <!--table { position: center; border-collapse: collapse; border-spacing: 0px; font-size: 10px;}

      td.t{font-family: verdana; color: white; background-color: #5060BA;font-weight: bold; border: 1px solid black; text-align: left;}

      td.t2{font-family: verdana; color: blue; font-weight: bold; text-align: center;}

      td {font-family: verdana; color: black; border: 1px solid black; text-align: right;}

      td.v{font-family: verdana; color: black; border: 1px solid black; text-align: right;}

      td.b{font-family: verdana; font-weight: bold; background-color: #FFFFFF; text-align: center;}

      td.n{font-family: verdana; color:#FF0000; background-color: #FFF710; text-align: right;}

      td.p{font-family: verdana; color:#009900; background-color: #FFF710; text-align: right;}

      td.n1{font-family: verdana; color:#FF0000; text-align: right;}

      td.p1{font-family: verdana; color:#009900; text-align: right;}

      td.x2{ padding: 3px; font-family: verdana; color: #5060BA; background-color: #DDFFD6; border: 1px solid black; text-align: right;}

      td.x3{ padding: 3px; font-family: verdana; color: #5060BA; background-color: #D8D6FF; border: 1px solid black; text-align: right;}-->

   </style></head>';

 v_tipo_encabezado   VARCHAR2 (500);

 v_fecha_carga       DATE;

 v_checker           NUMBER              := 0;

BEGIN
      --make connection to smtp
      c := UTL_SMTP.open_connection (p_smtp_hostname, p_smtp_portnum);
      --identify the domain of the sender
      UTL_SMTP.helo (c, p_smtp_hostname);
      --start a mail, specify the sender
      UTL_SMTP.mail (c, p_to);
      --identify recipient
      UTL_SMTP.rcpt (c, p_to);
      --start the mail body
      UTL_SMTP.open_data (c);
      UTL_SMTP.write_data (c, 'From: ' || p_sender || UTL_TCP.crlf);
      UTL_SMTP.write_data (c, 'To: ' || p_to || UTL_TCP.crlf);
      UTL_SMTP.write_data (c, 'Reply-to: ' || p_to || UTL_TCP.crlf);
      UTL_SMTP.write_data (c, 'Subject: ' || p_subject || UTL_TCP.crlf);
      px_html :=
            'MIME-Version: 1.0'
         || UTL_TCP.crlf
         ||                                          -- Use MIME mail standard
            'Content-Type: multipart/mixed;'
         || UTL_TCP.crlf
         || ' boundary="-----SECBOUND"'
         || UTL_TCP.crlf
         || UTL_TCP.crlf;
         UTL_SMTP.write_data (c, px_html);

      FOR x IN 1 .. 2
      LOOP
         IF x = 1
           THEN
            v_tipo_encabezado :=
                  '-------SECBOUND'
               || UTL_TCP.crlf
               || 'Content-Type: text/html;'
               || UTL_TCP.crlf
               || 'Content-Transfer_Encoding: 7bit'
               || UTL_TCP.crlf
               || UTL_TCP.crlf;
         ELSE
            v_tipo_encabezado :=
                  '-------SECBOUND'
               || UTL_TCP.crlf
               || 'Content-Type: text/plain;'
               || UTL_TCP.crlf
               || ' name="excel.csv"'
               || UTL_TCP.crlf
               || 'Content-Transfer_Encoding: 8bit'
               || UTL_TCP.crlf
               || 'Content-Disposition: attachment;'
               || UTL_TCP.crlf
               || ' filename="'
               || 'ETL_VENTAS'
               || TO_CHAR (SYSDATE, 'YYYYMMDD')
               || '_'
               || 'DWH'
               || '.xls'
               || UTL_TCP.crlf
               || UTL_TCP.crlf;
         END IF;



         UTL_SMTP.write_data (c, v_tipo_encabezado);
         px_html := v_encabezado_html;
         UTL_SMTP.write_data (c, UTL_TCP.crlf || px_html);
         px_html_tabla :=
            '<table>
                            <tr>
                                <td class="t" colspan="6">Ejemplo</td>
                            </tr>
                            <tr>
                                <td class = ''t''>campo1</td>
                                <td class = ''t''>campo2</td>    
                                <td class = ''t''>campo3</td>
                                <td class = ''t''>campo4</td>    
                                <td class = ''t''>INICIO</td>
                                <td class = ''t''>FIN</td>    
                            </tr>';
         UTL_SMTP.write_data (c, UTL_TCP.crlf || px_html_tabla);

         FOR x IN (select 
                  campo1,campo2,campo3,
                  campo4,to_char(fecha_inicio, 'DD-MM-YYY HH24:MI:SS') inicio,
                  to_char(fecha_fin, 'DD-MM-YYY HH24:MI:SS') fin 
                  from esquema.tabla
                  WHERE TRUNC(FECHA_INICIO)=TRUNC(SYSDATE))
         LOOP
            px_html_tabla :=
                  '<tr>
                  <td class="b">'
                  || x.campo1
                  || '</td>
                   <td class="b">'
                  || x.campo2
                  || '</td>    
                   <td class="b">'
                  || x.campo3
                  || '</td>
                   <td class="b">'
                  || x.campo4
                  || '</td>
                   <td class="b">'
                  || x.inicio
                  || '</td>
                  <td class="b">'
                  || x.fin
                  || '</td>';
             UTL_SMTP.write_data (c, UTL_TCP.crlf || px_html_tabla);
         END LOOP;

         px_html_tabla := '</tr></table>';
         UTL_SMTP.write_data (c, UTL_TCP.crlf || px_html_tabla);
         UTL_SMTP.write_data (c, UTL_TCP.crlf || ' ' || UTL_TCP.crlf);

      END LOOP;



      UTL_SMTP.close_data (c);
      UTL_SMTP.quit (c);

END;