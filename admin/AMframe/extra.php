<?php
class extra extends common
{
    public static $orgcdate;

    public function tooltip($profileid)
    {
        $uInfo = database::singlerec("select * from mlm_register where user_profileid='$profileid'");
        $sponid = $uInfo['user_sponserid'];
        $spInfo = database::singlerec("select * from mlm_register where user_profileid='$sponid'");
        $refCount = database::singlerec("select count(*) as tot from mlm_register where user_sponserid='$profileid'");
        $name = $uInfo['user_fname'] . " " . $uInfo['user_lname'];
        $reward_plan = "";

        $rp_id = $uInfo['reward_plan'];
        $reward_plan = database::singlerec("select * from reward_plans where id='$rp_id'");

        $reward_plan = $reward_plan['points']." Points";

        $disp = '<span><div style="width:300px" class="flyout">';
        $disp .= '<table width="100%" border="0" cellspacing="1" cellpadding="1"><tbody>';
        $disp .= "<tr style='font-size:13px'><td  align='left'>Name :</td><td align='left'>$name</td></tr>";
        $disp .= "<tr style='font-size:13px'><td align='left'>Reward Plan :</td><td align='left'>$reward_plan</td></tr>";
        $disp .= "<tr style='font-size:13px'><td align='left'>Profile Id :</td><td align='left'>$profileid</td></tr>";
        $disp .= "<tr style='font-size:13px'><td align='left'>Sponser Id :</td><td align='left'>$uInfo[user_sponserid]</td></tr>";
        $disp .= "<tr style='font-size:13px'><td align='left'>Sponser Name :</td><td align='left'>$spInfo[user_fname] $spInfo[user_lname]</td></tr>";
        $disp .= "<tr style='font-size:13px'><td align='left'>Refered :</td><td align='left'>$refCount[tot] user(s)</td></tr>";

        $disp .= "</tbody></table></div></span>";
        echo $disp;
    }

    public function usertree($profileid, $spnsr, $count)
    {
        global $website_url;
        if ($count == 0) {
            $dispcount = 1;
        } else {
            $dispcount = 2;
        }
        if ($count > 2) {
            return false;
        }
        $count++;
        $profileid = explode(",", $profileid);
        echo "<ul>";
        for ($i = 0; $i < $dispcount; $i++) {
            if (count($profileid) < 2) {
                $profileid[] = 0;
            }
            $user_profileid = $profileid[$i];
            $userInfo = database::singlerec("select * from mlm_register where user_profileid='$user_profileid'");
            $rp_id = $userInfo['reward_plan'];
            $reward_plan = database::singlerec("select * from reward_plans where id='$rp_id'");
            if ($i % 2 == 0) {
                if (!empty($userInfo)) {
                    echo "<li>";

                    echo '<a href="binary.php?uid=' . $user_profileid . '" class="tooltip1"><img src="images/' . $reward_plan['color'] . '-user.png">';



                    echo "<p style='font-weight:bold;font-style:italic;margin-bottom:0;'>$userInfo[user_fname] $userInfo[user_lname]</p>";
                    self::tooltip($user_profileid);
                    echo '</a>';
                    $dnLines = database::Extract_Single("select user_profileid from mlm_register where user_placementid='$user_profileid'");
                    $usr_cnt = database::Extract_Single("select count(user_profileid) as count from mlm_register where user_placementid='$user_profileid'");

                    if ($usr_cnt == 2) {
                        $asc_format = database::Extract_Single("select user_profileid from mlm_register where FIND_IN_SET(user_profileid,'$dnLines') order by user_position asc");
                    } else {
                        $tst = database::Extract_Single("select user_profileid from mlm_register where FIND_IN_SET(user_profileid,'$dnLines') order by user_position asc");
                        $pos = database::Extract_Single("select user_position from mlm_register where user_profileid='$tst'");
                        if ($pos == "Right") {
                            $pid[] = "";
                            $pid[] = $tst;
                            $asc_format = implode(",", $pid);
                        } else {
                            $asc_format = database::Extract_Single("select user_profileid from mlm_register where FIND_IN_SET(user_profileid,'$dnLines') order by user_position asc");
                        }
                    }

                    self::usertree($asc_format, $user_profileid, $count);
                    echo "</li>";
                } else {
                    echo '<li><a style="cursor:default;"><img src="images/free.png">';
                    echo '<p style="font-weight:bold;font-style:italic;color:red;margin-bottom:0;">Free Space</p></a></li>';
                }
            } else {
                if (!empty($userInfo)) {
                    echo "<li>";
                    echo '<a href="binary.php?uid=' . $user_profileid . '" class="tooltip1"><img src="images/' . $reward_plan['color'] . '-user.png">';

                    echo "<p style='font-weight:bold;font-style:italic;margin-bottom:0;'>$userInfo[user_fname] $userInfo[user_lname]</p>";
                    self::tooltip($user_profileid);
                    echo '</a>';
                    $dnLines = database::Extract_Single("select user_profileid from mlm_register where user_placementid='$user_profileid'");
                    $usr_cnt = database::Extract_Single("select count(user_profileid) as count from mlm_register where user_placementid='$user_profileid'");

                    if ($usr_cnt == 2) {
                        $asc_format = database::Extract_Single("select user_profileid from mlm_register where FIND_IN_SET(user_profileid,'$dnLines') order by user_position asc");
                    } else {
                        $tst = database::Extract_Single("select user_profileid from mlm_register where FIND_IN_SET(user_profileid,'$dnLines') order by user_position asc");
                        $pos = database::Extract_Single("select user_position from mlm_register where user_profileid='$tst'");
                        if ($pos == "Right") {
                            $pid[] = "";
                            $pid[] = $tst;
                            $asc_format = implode(",", $pid);
                        } else {
                            $asc_format = database::Extract_Single("select user_profileid from mlm_register where FIND_IN_SET(user_profileid,'$dnLines') order by user_position asc");
                        }
                    }
                    self::usertree($asc_format, $user_profileid, $count);
                    echo "</li>";
                } else {
                    echo '<li><a style="cursor:default;"><img src="images/free.png">';
                    echo '<p style="font-weight:bold;font-style:italic;color:red;margin-bottom:0;">Free Space</p></a></li>';
                }
            }
        }
        echo "</ul>";
    }

    public function exptree($profileid, $spnsr, $count)
    {
        if ($count == 0) {
            $dispcount = 1;
        } else {
            $dispcount = 2;
        }
        if ($count > 2) {
            return false;
        }
        $count++;
        $profileid = explode(",", $profileid);
        echo "<ul>";
        for ($i = 0; $i < $dispcount; $i++) {
            if (count($profileid) < 2) {
                $profileid[] = 0;
            }
            $user_profileid = $profileid[$i];
            $userInfo = database::singlerec("select * from mlm_register where user_profileid='$user_profileid'");
            if ($i % 2 == 0) {
                if (!empty($userInfo)) {
                    echo "<li>";
                    echo '<a><img src="images/no-blue.jpg" width="90"></a>';
                    echo "<p style='font-weight:bold;font-style:italic;margin-bottom:0;'>$userInfo[user_fname] $userInfo[user_lname]</p>";
                    $dnLine = database::Extract_Single("select user_profileid from mlm_register where user_placementid='$user_profileid'");
                    self::exptree($dnLine, $user_profileid, $count);
                    echo "</li>";
                } else {
                    echo '<li><a><img src="images/no-blue.jpg" width="90"></a>';
                    echo '<p style="font-weight:bold;font-style:italic;color:red;margin-bottom:0;">Free Space</p></a></li>';
                }
            } else {
                if (!empty($userInfo)) {
                    echo "<li>";
                    echo '<a><img src="images/no-blue.jpg" width="90"></a>';
                    echo "<p style='font-weight:bold;font-style:italic;margin-bottom:0;'>$userInfo[user_fname] $userInfo[user_lname]</p>";
                    $dnLine = database::Extract_Single("select user_profileid from mlm_register where user_placementid='$user_profileid'");
                    self::exptree($dnLine, $user_profileid, $count);
                    echo "</li>";
                } else {
                    echo '<li><a><img src="images/no-blue.jpg" width="90"></a>';
                    echo '<p style="font-weight:bold;font-style:italic;color:red;margin-bottom:0;">Free Space</p></a></li>';
                }
            }
        }
        echo "</ul>";
    }

    public function ismemExpired($profileid)
    {
        $memInfo = database::singlerec("select * from mlm_mempayments where profileid='$profileid' and status='Completed' order by id desc");
        if (!empty($memInfo)) {
            $day = database::singlerec("select * from mlm_membership where id='$memInfo[pack]'");
            $days = $day['days'];
            $curdate = time();
            $orgcdate = $memInfo['created_at'];
            $cdate = strtotime($memInfo['created_at']);
            $expdate = strtotime("$orgcdate + $days days");
            self::$orgcdate = $orgcdate;
            if ($curdate > $expdate) {
                return true;
            } else {
                return false;
            };
        } else {
            return true;
        }
    }

    public function renewIn()
    {
        $orgcdate = self::$orgcdate;
        $renewIn = strtotime("$orgcdate +40 days");
        $curdate = time();
        $renewIn = ($renewIn - $curdate) / 24 / 3600;
        return floor($renewIn);
    }

    public function expiresIn($orgcdate, $days)
    {
        $renewIn = strtotime("$orgcdate + $days days");
        $curdate = time();
        $renewIn = ($renewIn - $curdate) / 24 / 3600;
        return floor($renewIn);
    }

    public function pdfExport($arr, $table, $que = "")
    {
        $column = implode(",", $arr);
        $info = database::get_all_assoc("select $column from $table $que");
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 8);
        foreach ($arr as $heading) {
            $pdf->Cell(45, 8, $heading, 1);
        }
        foreach ($info as $row) {
            $pdf->SetFont('Arial', '', 8);
            $pdf->Ln();
            foreach ($row as $column) {
                $pdf->Cell(45, 8, $column, 1);
            }
        }
        $pdf->Output();
    }

    public function pdfExportbtn($arr, $table, $que = "")
    {
        $arr = json_encode((object) $arr);
        $arr = urlencode($arr);
        $que = urlencode($que);
        echo '<form target="_blank" action="pdfexport.php" method="post">';
        echo '<input type="hidden" name="arr" value="' . $arr . '">';
        echo '<input type="hidden" name="table" value="' . $table . '">';
        echo '<input type="hidden" name="que" value="' . $que . '">';
        echo '<button type="submit" style="color:#FFFFFF; margin-top:5px;margin-left: 10px;" class="btn btn-small btn-grey pull-left btn-info"/>Export to PDF</button>';
        echo '</form>';
    }
}
