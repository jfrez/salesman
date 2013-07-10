<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
*/
function setErrorMessage($error, $messagetype) {
    $ci = get_instance();
    $ci->session->set_flashdata('message',$error);
    $ci->session->set_flashdata('messagetype',$messagetype);
}

function getProjectTypesAsOption() {

    $ci = get_instance();
    $ci->load->model("ptypesmodel","tm");
    $types = $ci->tm->getTypes();
    $data = '';
    //showArray($types);
    foreach($types as $t)
        $data .= '<option value="'.$t['id'].'">'.$t['name'].'</option>';
    return $data;
}
function getRegionsAsOption() {
    $ci = get_instance();
    $ci->load->model("regionsmodel","rrm");
    $regions = $ci->rrm->getRegions();
    $data = '';
    //showArray($types);
    foreach($regions as $r)
        $data .= '<option value="'.$r['id'].'">'.$r['name'].'</option>';

    return $data;

}
function getStatesAsOption() {
    return '<option value="Alabama">Alabama</option>
<option value="Alaska">Alaska</option>
<option value="Arizona">Arizona</option>
<option value="Arkansas">Arkansas</option>
<option value="California">California</option>
<option value="Colorado">Colorado</option>
<option value="Connecticut">Connecticut</option>
<option value="Delaware">Delaware</option>
<option value="Florida">Florida</option>
<option value="Georgia">Georgia</option>
<option value="Hawaii">Hawaii</option>
<option value="Idaho">Idaho</option>
<option value="Illinois">Illinois</option>
<option value="Indiana">Indiana</option>
<option value="Iowa">Iowa</option>
<option value="Kansas">Kansas</option>
<option value="Kentucky">Kentucky</option>
<option value="Louisiana">Louisiana</option>
<option value="Maine">Maine</option>
<option value="Maryland">Maryland</option>
<option value="Massachusetts">Massachusetts</option>
<option value="Michigan">Michigan</option>
<option value="Minnesota">Minnesota</option>
<option value="Mississippi">Mississippi</option>
<option value="Missouri">Missouri</option>
<option value="Montana">Montana</option>
<option value="Nebraska">Nebraska</option>
<option value="Nevada">Nevada</option>
<option value="New Hampshire">New Hampshire</option>
<option value="New Jersey">New Jersey</option>
<option value="New Mexico">New Mexico</option>
<option value="New York">New York</option>
<option value="North Carolina">North Carolina</option>
<option value="North Dakota">North Dakota</option>
<option value="Ohio">Ohio</option>
<option value="Oklahoma">Oklahoma</option>
<option value="Oregon">Oregon</option>
<option value="Pennsylvania">Pennsylvania</option>
<option value="Rhode Island">Rhode Island</option>
<option value="South Carolina">South Carolina</option>
<option value="South Dakota">South Dakota</option>
<option value="Tennessee">Tennessee</option>
<option value="Texas">Texas</option>
<option value="Utah">Utah</option>
<option value="Vermont">Vermont</option>
<option value="Virginia">Virginia</option>
<option value="Washington">Washington</option>
<option value="West Virginia">West Virginia</option>
<option value="Wisconsin">Wisconsin</option>
<option value="Wyoming">Wyoming</option>';
}
function getCountriesAsOption() {
    return '<option value="">Country...</option>
<option value="Afganistan">Afghanistan</option>
<option value="Albania">Albania</option>
<option value="Algeria">Algeria</option>
<option value="American Samoa">American Samoa</option>
<option value="Andorra">Andorra</option>
<option value="Angola">Angola</option>
<option value="Anguilla">Anguilla</option>
<option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
<option value="Argentina">Argentina</option>
<option value="Armenia">Armenia</option>
<option value="Aruba">Aruba</option>
<option value="Australia">Australia</option>
<option value="Austria">Austria</option>
<option value="Azerbaijan">Azerbaijan</option>
<option value="Bahamas">Bahamas</option>
<option value="Bahrain">Bahrain</option>
<option value="Bangladesh">Bangladesh</option>
<option value="Barbados">Barbados</option>
<option value="Belarus">Belarus</option>
<option value="Belgium">Belgium</option>
<option value="Belize">Belize</option>
<option value="Benin">Benin</option>
<option value="Bermuda">Bermuda</option>
<option value="Bhutan">Bhutan</option>
<option value="Bolivia">Bolivia</option>
<option value="Bonaire">Bonaire</option>
<option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
<option value="Botswana">Botswana</option>
<option value="Brazil">Brazil</option>
<option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
<option value="Brunei">Brunei</option>
<option value="Bulgaria">Bulgaria</option>
<option value="Burkina Faso">Burkina Faso</option>
<option value="Burundi">Burundi</option>
<option value="Cambodia">Cambodia</option>
<option value="Cameroon">Cameroon</option>
<option value="Canada">Canada</option>
<option value="Canary Islands">Canary Islands</option>
<option value="Cape Verde">Cape Verde</option>
<option value="Cayman Islands">Cayman Islands</option>
<option value="Central African Republic">Central African Republic</option>
<option value="Chad">Chad</option>
<option value="Channel Islands">Channel Islands</option>
<option value="Chile">Chile</option>
<option value="China">China</option>
<option value="Christmas Island">Christmas Island</option>
<option value="Cocos Island">Cocos Island</option>
<option value="Colombia">Colombia</option>
<option value="Comoros">Comoros</option>
<option value="Congo">Congo</option>
<option value="Cook Islands">Cook Islands</option>
<option value="Costa Rica">Costa Rica</option>
<option value="Cote DIvoire">Cote D\'Ivoire</option>
<option value="Croatia">Croatia</option>
<option value="Cuba">Cuba</option>
<option value="Curaco">Curacao</option>
<option value="Cyprus">Cyprus</option>
<option value="Czech Republic">Czech Republic</option>
<option value="Denmark">Denmark</option>
<option value="Djibouti">Djibouti</option>
<option value="Dominica">Dominica</option>
<option value="Dominican Republic">Dominican Republic</option>
<option value="East Timor">East Timor</option>
<option value="Ecuador">Ecuador</option>
<option value="Egypt">Egypt</option>
<option value="El Salvador">El Salvador</option>
<option value="Equatorial Guinea">Equatorial Guinea</option>
<option value="Eritrea">Eritrea</option>
<option value="Estonia">Estonia</option>
<option value="Ethiopia">Ethiopia</option>
<option value="Falkland Islands">Falkland Islands</option>
<option value="Faroe Islands">Faroe Islands</option>
<option value="Fiji">Fiji</option>
<option value="Finland">Finland</option>
<option value="France">France</option>
<option value="French Guiana">French Guiana</option>
<option value="French Polynesia">French Polynesia</option>
<option value="French Southern Ter">French Southern Ter</option>
<option value="Gabon">Gabon</option>
<option value="Gambia">Gambia</option>
<option value="Georgia">Georgia</option>
<option value="Germany">Germany</option>
<option value="Ghana">Ghana</option>
<option value="Gibraltar">Gibraltar</option>
<option value="Great Britain">Great Britain</option>
<option value="Greece">Greece</option>
<option value="Greenland">Greenland</option>
<option value="Grenada">Grenada</option>
<option value="Guadeloupe">Guadeloupe</option>
<option value="Guam">Guam</option>
<option value="Guatemala">Guatemala</option>
<option value="Guinea">Guinea</option>
<option value="Guyana">Guyana</option>
<option value="Haiti">Haiti</option>
<option value="Hawaii">Hawaii</option>
<option value="Honduras">Honduras</option>
<option value="Hong Kong">Hong Kong</option>
<option value="Hungary">Hungary</option>
<option value="Iceland">Iceland</option>
<option value="India">India</option>
<option value="Indonesia">Indonesia</option>
<option value="Iran">Iran</option>
<option value="Iraq">Iraq</option>
<option value="Ireland">Ireland</option>
<option value="Isle of Man">Isle of Man</option>
<option value="Israel">Israel</option>
<option value="Italy">Italy</option>
<option value="Jamaica">Jamaica</option>
<option value="Japan">Japan</option>
<option value="Jordan">Jordan</option>
<option value="Kazakhstan">Kazakhstan</option>
<option value="Kenya">Kenya</option>
<option value="Kiribati">Kiribati</option>
<option value="Korea North">Korea North</option>
<option value="Korea Sout">Korea South</option>
<option value="Kuwait">Kuwait</option>
<option value="Kyrgyzstan">Kyrgyzstan</option>
<option value="Laos">Laos</option>
<option value="Latvia">Latvia</option>
<option value="Lebanon">Lebanon</option>
<option value="Lesotho">Lesotho</option>
<option value="Liberia">Liberia</option>
<option value="Libya">Libya</option>
<option value="Liechtenstein">Liechtenstein</option>
<option value="Lithuania">Lithuania</option>
<option value="Luxembourg">Luxembourg</option>
<option value="Macau">Macau</option>
<option value="Macedonia">Macedonia</option>
<option value="Madagascar">Madagascar</option>
<option value="Malaysia">Malaysia</option>
<option value="Malawi">Malawi</option>
<option value="Maldives">Maldives</option>
<option value="Mali">Mali</option>
<option value="Malta">Malta</option>
<option value="Marshall Islands">Marshall Islands</option>
<option value="Martinique">Martinique</option>
<option value="Mauritania">Mauritania</option>
<option value="Mauritius">Mauritius</option>
<option value="Mayotte">Mayotte</option>
<option value="Mexico">Mexico</option>
<option value="Midway Islands">Midway Islands</option>
<option value="Moldova">Moldova</option>
<option value="Monaco">Monaco</option>
<option value="Mongolia">Mongolia</option>
<option value="Montserrat">Montserrat</option>
<option value="Morocco">Morocco</option>
<option value="Mozambique">Mozambique</option>
<option value="Myanmar">Myanmar</option>
<option value="Nambia">Nambia</option>
<option value="Nauru">Nauru</option>
<option value="Nepal">Nepal</option>
<option value="Netherland Antilles">Netherland Antilles</option>
<option value="Netherlands">Netherlands (Holland, Europe)</option>
<option value="Nevis">Nevis</option>
<option value="New Caledonia">New Caledonia</option>
<option value="New Zealand">New Zealand</option>
<option value="Nicaragua">Nicaragua</option>
<option value="Niger">Niger</option>
<option value="Nigeria">Nigeria</option>
<option value="Niue">Niue</option>
<option value="Norfolk Island">Norfolk Island</option>
<option value="Norway">Norway</option>
<option value="Oman">Oman</option>
<option value="Pakistan">Pakistan</option>
<option value="Palau Island">Palau Island</option>
<option value="Palestine">Palestine</option>
<option value="Panama">Panama</option>
<option value="Papua New Guinea">Papua New Guinea</option>
<option value="Paraguay">Paraguay</option>
<option value="Peru">Peru</option>
<option value="Phillipines">Philippines</option>
<option value="Pitcairn Island">Pitcairn Island</option>
<option value="Poland">Poland</option>
<option value="Portugal">Portugal</option>
<option value="Puerto Rico">Puerto Rico</option>
<option value="Qatar">Qatar</option>
<option value="Republic of Montenegro">Republic of Montenegro</option>
<option value="Republic of Serbia">Republic of Serbia</option>
<option value="Reunion">Reunion</option>
<option value="Romania">Romania</option>
<option value="Russia">Russia</option>
<option value="Rwanda">Rwanda</option>
<option value="St Barthelemy">St Barthelemy</option>
<option value="St Eustatius">St Eustatius</option>
<option value="St Helena">St Helena</option>
<option value="St Kitts-Nevis">St Kitts-Nevis</option>
<option value="St Lucia">St Lucia</option>
<option value="St Maarten">St Maarten</option>
<option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
<option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
<option value="Saipan">Saipan</option>
<option value="Samoa">Samoa</option>
<option value="Samoa American">Samoa American</option>
<option value="San Marino">San Marino</option>
<option value="Sao Tome & Principe">Sao Tome &amp; Principe</option>
<option value="Saudi Arabia">Saudi Arabia</option>
<option value="Senegal">Senegal</option>
<option value="Seychelles">Seychelles</option>
<option value="Sierra Leone">Sierra Leone</option>
<option value="Singapore">Singapore</option>
<option value="Slovakia">Slovakia</option>
<option value="Slovenia">Slovenia</option>
<option value="Solomon Islands">Solomon Islands</option>
<option value="Somalia">Somalia</option>
<option value="South Africa">South Africa</option>
<option value="Spain">Spain</option>
<option value="Sri Lanka">Sri Lanka</option>
<option value="Sudan">Sudan</option>
<option value="Suriname">Suriname</option>
<option value="Swaziland">Swaziland</option>
<option value="Sweden">Sweden</option>
<option value="Switzerland">Switzerland</option>
<option value="Syria">Syria</option>
<option value="Tahiti">Tahiti</option>
<option value="Taiwan">Taiwan</option>
<option value="Tajikistan">Tajikistan</option>
<option value="Tanzania">Tanzania</option>
<option value="Thailand">Thailand</option>
<option value="Togo">Togo</option>
<option value="Tokelau">Tokelau</option>
<option value="Tonga">Tonga</option>
<option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
<option value="Tunisia">Tunisia</option>
<option value="Turkey">Turkey</option>
<option value="Turkmenistan">Turkmenistan</option>
<option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
<option value="Tuvalu">Tuvalu</option>
<option value="Uganda">Uganda</option>
<option value="Ukraine">Ukraine</option>
<option value="United Arab Erimates">United Arab Emirates</option>
<option value="United Kingdom">United Kingdom</option>
<option value="United States of America" selected>United States of America</option>
<option value="Uraguay">Uruguay</option>
<option value="Uzbekistan">Uzbekistan</option>
<option value="Vanuatu">Vanuatu</option>
<option value="Vatican City State">Vatican City State</option>
<option value="Venezuela">Venezuela</option>
<option value="Vietnam">Vietnam</option>
<option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
<option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
<option value="Wake Island">Wake Island</option>
<option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
<option value="Yemen">Yemen</option>
<option value="Zaire">Zaire</option>
<option value="Zambia">Zambia</option>
<option value="Zimbabwe">Zimbabwe</option>';
    //return <option value='1'>Project Type1 Blah Blah</option>
    //....
}
function getBuildCrewsAsOption() {
    //return <option value='1'>Project Type1 Blah Blah</option>
    //....
}
function getBuildTypesAsOption() {
    //return <option value='1'>Project Type1 Blah Blah</option>
    //....
    $data = "";
    $ci = get_instance();
    $ci->load->model("typesmodel","ttm");
    $roles = $ci->ttm->getTypes();
    foreach($roles as $role) {
        $data.= "<option value='{$role['id']}'>{$role['name']}</option>";
    }
    return $data;

}
function getBuildTypesAsArray() {
    //return <option value='1'>Project Type1 Blah Blah</option>
    //....
    $data = "";
    $ci = get_instance();
    $ci->load->model("typesmodel","ttm");
    $roles = $ci->ttm->getTypes();
    
    return $roles;

}
function getProductGroupsAsOption() {
    //return <option value='1'>Project Type1 Blah Blah</option>
    //....
    $data = "";
    $ci = get_instance();
    $ci->load->model("pgmodel","pgm");
    $roles = $ci->pgm->getGroups();
    foreach($roles as $role) {
        $data.= "<option value='{$role['id']}'>{$role['name']}</option>";
    }
    return $data;

}

function redirectToCrew() {
    //die("here");
    $ci = get_instance();
    $baseurl = $ci->config->item("base_url");
    $cpurl = $baseurl."admin/crews";
    header("Location:{$cpurl}");
    return false;
}

function redirectToClient() {
    $ci = get_instance();
    $baseurl = $ci->config->item("base_url");
    $cpurl = $baseurl."/clients";
    header("Location:{$cpurl}");
    return false;
}
function redirectToLogin() {
    $ci = get_instance();
    $baseurl = $ci->config->item("base_url");
    $cpurl = $baseurl."login";
    header("Location:{$cpurl}");
    return false;
}
function redirectToAdmin($tab) {
    $ci = get_instance();
    $baseurl = $ci->config->item("base_url");
    $cpurl = $baseurl."admin/cpanel/{$tab}";
    header("Location:{$cpurl}");
    return false;
}


function redirectToHome() {
    $ci = get_instance();
    $baseurl = $ci->config->item("base_url");
    $cpurl = $baseurl."admin/home";
    header("Location:{$cpurl}");
    return false;
}

function redirectToDboard() {
    $ci = get_instance();
    $baseurl = $ci->config->item("base_url");
    $cpurl = $baseurl."admin/index";
    header("Location:{$cpurl}");
    return false;
}

function redirectToInsurance() {
    $ci = get_instance();
    $baseurl = $ci->config->item("base_url");
    $url = $baseurl."admin/insurance";
    header("Location:{$url}");
    return false;
}


function redirectToFile($id,$image) {
    $ci = get_instance();
    $baseurl = $ci->config->item("base_url");
    if($image)
    $url = $baseurl."admin/home/".$id."/images";
    else
    $url = $baseurl."admin/home/".$id."/files";
    //echo $url;
    header("Location:{$url}");
    return false;
}

function redirectToRegionCrew($rid) {
    $ci = get_instance();
    $baseurl = $ci->config->item("base_url");
    $url = $baseurl."admin/regions/{$rid}/rtab4";
    header("Location:{$url}");
    return false;
}


function redirectToProject() {
    $ci = get_instance();
    $baseurl = $ci->config->item("base_url");
    $url = $baseurl."admin/home";
    header("Location:{$url}");
    return false;
}


function redirectToRegions($id,$tab) {
    $ci = get_instance();
    $baseurl = $ci->config->item("base_url");
    $url = $baseurl."admin/regions/".$id.'/'.$tab;
    header("Location:{$url}");
    return false;
}

function getRolesAsAdmin() {

}

function getRolesAsOption() {
    $data = "";
    $ci = get_instance();
    $ci->load->model("rolesmodel","rm");
    $roles = $ci->rm->getRoles();
    foreach($roles as $role) {
        $data.= "<option value='{$role['id']}'>{$role['name']}</option>";
    }
    return $data;
}

function getUsersWithRolesAsOptions() {
    $ci = get_instance();
    $ci->load->model("usersmodel","um");
    $users = $ci->um->getUsers();
    //die("Hmm");
    $roles = array();
    $data = "<option value='0'>Select User</option>";
    foreach ($users as $id=>$user) {
        $roles[$user['role']][$user['id']] = $user['name'];
    }
    foreach ($roles as $name=>$role) {
        $data.= "<optgroup label='{$name}'>";
        foreach ($role as $id=>$user) {
            $data .= "<option value='{$id}'>{$user}</option>";
        }
        $data.= "</optgroup>";
    }
    return $data;
}


function getProjectsAsOptions() {
    $data = "";
    $ci = get_instance();
    $ci->load->model("projectsmodel","pm");
    $projects = $ci->pm->getAllProjects();
    foreach($projects as $project) {
        $data .= "<option value='{$project['id']}'>{$project['name']}</option>";
    }
    return $data;
}

function getSalesPerson() {
    $ci = get_instance();
    $ci->load->model("usersmodel","um");
    $users = $ci->um->getSalesPerons();
    $data = "<option value='0'>Select Sales Manager</option>";
    foreach($users as $user) {
        $data .= "<option value='{$user['user_id']}'>{$user['name']}</option>";
    }
    return $data;
}

function showArray($Array) {
    echo '<pre>';
    print_r($Array);
    echo '</pre>';
}



function getAccountStatus($time) {

    if($time=='' || $time=='0')
    {
        $ret = "<span style='padding:5px;color:#333'>N/A</span>";
        return $ret;
    }

    $diff = datediff('d',$time,time(),true);

    if($diff<30)
        $ret = "<span style='background:#41A317;padding:5px;color:#fff'>Current</span>";
    else if($diff > 30 && $diff<45 )
        $ret = "<span style='background:#41A317;padding:5px;color:#fff'>Past 30 days</span>";
    else if($diff > 45 && $diff<60 )
        $ret = "<span style='background:#41A317;padding:5px;color:#fff'>Past 45 days</span>";
    else if($diff > 60 && $diff<90 )
        $ret = "<span style='background:#FF0000;padding:5px;color:#fff'>Past 60 days</span>";
    else
        $ret = "<span style='background:#000;padding:5px;color:#fff'>Loss</span>";

    return $ret;
}


function datediff($interval, $datefrom, $dateto, $using_timestamps = false) {
    /*
	$interval can be:
	yyyy - Number of full years
	q - Number of full quarters
	m - Number of full months
	y - Difference between day numbers
	(eg 1st Jan 2004 is "1", the first day. 2nd Feb 2003 is "33". The datediff is "-32".)
	d - Number of full days
	w - Number of full weekdays
	ww - Number of full weeks
	h - Number of full hours
	n - Number of full minutes
	s - Number of full seconds (default)
    */

    if (!$using_timestamps) {
        $datefrom = strtotime($datefrom, 0);
        $dateto = strtotime($dateto, 0);
    }
    $difference = $dateto - $datefrom; // Difference in seconds

    switch($interval) {

        case 'yyyy': // Number of full years

            $years_difference = floor($difference / 31536000);
            if (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom), date("j", $datefrom), date("Y", $datefrom)+$years_difference) > $dateto) {
                $years_difference--;
            }
            if (mktime(date("H", $dateto), date("i", $dateto), date("s", $dateto), date("n", $dateto), date("j", $dateto), date("Y", $dateto)-($years_difference+1)) > $datefrom) {
                $years_difference++;
            }
            $datediff = $years_difference;
            break;

        case "q": // Number of full quarters

            $quarters_difference = floor($difference / 8035200);
            while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($quarters_difference*3), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                $months_difference++;
            }
            $quarters_difference--;
            $datediff = $quarters_difference;
            break;

        case "m": // Number of full months

            $months_difference = floor($difference / 2678400);
            while (mktime(date("H", $datefrom), date("i", $datefrom), date("s", $datefrom), date("n", $datefrom)+($months_difference), date("j", $dateto), date("Y", $datefrom)) < $dateto) {
                $months_difference++;
            }
            $months_difference--;
            $datediff = $months_difference;
            break;

        case 'y': // Difference between day numbers

            $datediff = date("z", $dateto) - date("z", $datefrom);
            break;

        case "d": // Number of full days

            $datediff = floor($difference / 86400);
            break;

        case "w": // Number of full weekdays

            $days_difference = floor($difference / 86400);
            $weeks_difference = floor($days_difference / 7); // Complete weeks
            $first_day = date("w", $datefrom);
            $days_remainder = floor($days_difference % 7);
            $odd_days = $first_day + $days_remainder; // Do we have a Saturday or Sunday in the remainder?
            if ($odd_days > 7) { // Sunday
                $days_remainder--;
            }
            if ($odd_days > 6) { // Saturday
                $days_remainder--;
            }
            $datediff = ($weeks_difference * 5) + $days_remainder;
            break;

        case "ww": // Number of full weeks

            $datediff = floor($difference / 604800);
            break;

        case "h": // Number of full hours

            $datediff = floor($difference / 3600);
            break;

        case "n": // Number of full minutes

            $datediff = floor($difference / 60);
            break;

        default: // Number of full seconds (default)

            $datediff = $difference;
            break;
    }

    return $datediff;

}
function getCrewsAsOption() {
    $data = "";
    $ci = get_instance();
    $ci->load->model("crewsmodel","cm");
    $roles = $ci->cm->getAllCrews();
    foreach($roles as $role) {
        $data.= "<option value='{$role['id']}'>{$role['name']}</option>";
    }
    return $data;
}


function getFilePath($id) {
    $ci = get_instance();
    $ci->load->model('filesmodel');
    $path = $ci->filesmodel->getPath($id);
    $type = $ci->filesmodel->isImage($id);
    $path = str_replace("uploads","",$path);
    if($type=='0')
    return $ci->config->item("upload_path")."/files/".$path;
    else
    return $ci->config->item("upload_path")."/images/original/".$path;
}
function getPitchAsOption(){
    return '<option value="8 1/2">8 1/2</option>
            <option value="9 1/2">9 1/2</option>
            <option value="10 1/2">10 1/2</option>
            <option value="11 1/2">11 1/2</option>
            <option value="12+">12+</option>';
}
function getLayersAsOption(){
    return ' <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>';
}


?>