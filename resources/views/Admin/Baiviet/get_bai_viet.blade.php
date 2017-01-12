<?php
echo '<?xml version="1.0" encoding="iso-8859-1" ?>';
echo '<rows>';
echo '<head>
        <column type="edn" width="150" sort="str" format="0.00">
            Column label
        </column>
        <column type="ro" width="150" sort="na" color="red">
            One more label
        </column>
        <column type="co" width="150" sort="na" id="last">
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
        </column>
    </head>';

    echo '
    <row id="11">
        <userdata name="some_1">value_1</userdata>
        <cell> first column data </cell>
        <cell> second column data </cell>
    </row>
    <row id="12" class="css1" bgColor="red" style="color:blue;">
        <cell> first column data </cell>
        <cell class="css2" style="font-weight:bold;"> second column data </cell>
    </row>
    <row id="13" locked="true" >
        <cell colspan="2" rowspan="1"> first column data </cell>
        <cell></cell>
    </row>
    <row id="14" selected="true" call="true">
        <cell type="ro"> first column data </cell>
        <cell></cell>
    </row>
    <row id="15">
        <cell><![CDATA[
            <input type="button" value="any" />
            ]]></cell>
        <cell> second column data </cell>
    </row>';
echo '</rows>';
