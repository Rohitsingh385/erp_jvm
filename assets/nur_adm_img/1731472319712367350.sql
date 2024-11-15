-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2024 at 08:55 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `playschool_db_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `absent_teacher_table`
--

CREATE TABLE `absent_teacher_table` (
  `S_No` int(11) DEFAULT NULL,
  `Absent_Teacher_Name` varchar(255) DEFAULT NULL,
  `New_Teacher_ID_Name` varchar(255) DEFAULT NULL,
  `Assign_Day` varchar(255) DEFAULT NULL,
  `Assign_Period` varchar(100) DEFAULT NULL,
  `Assign_Period_Details` varchar(255) DEFAULT NULL,
  `Assign_date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `accg`
--

CREATE TABLE `accg` (
  `CAT_CODE` double NOT NULL,
  `CAT_ABBR` varchar(150) DEFAULT NULL,
  `CAT_DESC` varchar(150) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `accscg`
--

CREATE TABLE `accscg` (
  `CAT_ABBR` varchar(30) DEFAULT NULL,
  `CAT_DESC` varchar(50) DEFAULT NULL,
  `CAT_Amt` double DEFAULT NULL,
  `cat_code` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `acessionmaster`
--

CREATE TABLE `acessionmaster` (
  `RefNo` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `acgroup`
--

CREATE TABLE `acgroup` (
  `AcName` varchar(100) DEFAULT NULL,
  `GName` varchar(50) DEFAULT NULL,
  `AcType` varchar(50) DEFAULT NULL,
  `YesNo` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `acnar`
--

CREATE TABLE `acnar` (
  `Id` int(11) NOT NULL,
  `Act` text DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `activity_master`
--

CREATE TABLE `activity_master` (
  `Activity_Id` int(11) DEFAULT NULL,
  `Activity` varchar(50) DEFAULT NULL,
  `sub_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `activity_nonactivity`
--

CREATE TABLE `activity_nonactivity` (
  `activity` bit(1) DEFAULT NULL,
  `Non_activity` bit(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `adm_no`
--

CREATE TABLE `adm_no` (
  `ID` varchar(200) NOT NULL,
  `adm_no` varchar(20) NOT NULL,
  `studentid` varchar(20) DEFAULT NULL,
  `chartno` varchar(20) DEFAULT NULL,
  `bonano` varchar(255) DEFAULT NULL,
  `dobno` varchar(255) DEFAULT NULL,
  `tcno` varchar(20) DEFAULT NULL,
  `Current_Year` varchar(20) DEFAULT NULL,
  `FeeType` smallint(6) DEFAULT NULL,
  `MasterLedger` int(11) DEFAULT NULL,
  `tchead` varchar(50) DEFAULT NULL,
  `Tution_fee_Head` int(11) DEFAULT NULL,
  `Caution_Money` int(11) DEFAULT NULL,
  `EMP_ID` varchar(255) DEFAULT NULL,
  `STD_ID` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `advance_salary_history`
--

CREATE TABLE `advance_salary_history` (
  `ID` int(11) NOT NULL,
  `EMPLOYEE_ID` int(11) NOT NULL,
  `AMOUNT` double NOT NULL,
  `DATE` varchar(255) NOT NULL,
  `NO_OF_INSTALLMENT` int(11) NOT NULL,
  `STATUS` int(11) NOT NULL DEFAULT 1 COMMENT '1 = ADVANCE,  2 = DEDUCTION',
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `UPDATED_AT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `allowance_master`
--

CREATE TABLE `allowance_master` (
  `Alo_ID1` int(11) DEFAULT NULL,
  `Alo_Nm1` varchar(255) DEFAULT NULL,
  `Alo_ID2` int(11) DEFAULT NULL,
  `Alo_Nm2` varchar(255) DEFAULT NULL,
  `Alo_ID3` int(11) DEFAULT NULL,
  `Alo_Nm3` varchar(255) DEFAULT NULL,
  `Alo_ID4` int(11) DEFAULT NULL,
  `Alo_Nm4` varchar(255) DEFAULT NULL,
  `Alo_ID5` int(11) DEFAULT NULL,
  `Alo_Nm5` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `allowance_name`
--

CREATE TABLE `allowance_name` (
  `ID` int(11) DEFAULT NULL,
  `Allowance_Name` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `amemp`
--

CREATE TABLE `amemp` (
  `SNo` int(11) DEFAULT NULL,
  `EID` varchar(50) DEFAULT NULL,
  `EN` varchar(50) DEFAULT NULL,
  `PAdd` varchar(100) DEFAULT NULL,
  `PCity` varchar(50) DEFAULT NULL,
  `PDist` varchar(50) DEFAULT NULL,
  `PState` varchar(50) DEFAULT NULL,
  `PPin` varchar(50) DEFAULT NULL,
  `PPh` varchar(50) DEFAULT NULL,
  `PFax` varchar(50) DEFAULT NULL,
  `PMob` varchar(50) DEFAULT NULL,
  `PEmail` varchar(50) DEFAULT NULL,
  `CAdd` varchar(100) DEFAULT NULL,
  `CCity` varchar(50) DEFAULT NULL,
  `CDist` varchar(50) DEFAULT NULL,
  `CState` varchar(50) DEFAULT NULL,
  `CPin` varchar(50) DEFAULT NULL,
  `CPh` varchar(50) DEFAULT NULL,
  `CFax` varchar(50) DEFAULT NULL,
  `CMob` varchar(50) DEFAULT NULL,
  `CEmail` varchar(50) DEFAULT NULL,
  `DOB` datetime DEFAULT NULL,
  `DOJ_DAV` datetime DEFAULT NULL,
  `DOJ_Sch` datetime DEFAULT NULL,
  `DORetire` datetime DEFAULT NULL,
  `DOJ_PF` datetime DEFAULT NULL,
  `DOJ_Scale` datetime DEFAULT NULL,
  `Sex` varchar(10) DEFAULT NULL,
  `FName` varchar(50) DEFAULT NULL,
  `Qul` varchar(50) DEFAULT NULL,
  `Cadre` int(11) DEFAULT NULL,
  `Des` int(11) DEFAULT NULL,
  `PFAcNo` varchar(50) DEFAULT NULL,
  `PenAcNo` varchar(50) DEFAULT NULL,
  `PayScale` varchar(50) DEFAULT NULL,
  `BasicPay` double DEFAULT NULL,
  `BankAcNo` varchar(50) DEFAULT NULL,
  `PanNo` varchar(50) DEFAULT NULL,
  `CLeave` int(11) DEFAULT NULL,
  `ELeave` int(11) DEFAULT NULL,
  `Adhoc` bit(1) DEFAULT NULL,
  `Mar_Status` varchar(50) DEFAULT NULL,
  `InsPol1` varchar(50) DEFAULT NULL,
  `PremAmt1` decimal(18,2) DEFAULT NULL,
  `INomi1` varchar(50) DEFAULT NULL,
  `InsPol2` varchar(50) DEFAULT NULL,
  `PremAmt2` decimal(18,2) DEFAULT NULL,
  `INomi2` varchar(50) DEFAULT NULL,
  `InsPol3` varchar(50) DEFAULT NULL,
  `PremAmt3` decimal(18,2) DEFAULT NULL,
  `INomi3` varchar(50) DEFAULT NULL,
  `InsPol4` varchar(50) DEFAULT NULL,
  `PremAmt4` decimal(18,2) DEFAULT NULL,
  `INomi4` varchar(50) DEFAULT NULL,
  `InsPol5` varchar(50) DEFAULT NULL,
  `PremAmt5` decimal(18,2) DEFAULT NULL,
  `INomi5` varchar(50) DEFAULT NULL,
  `NName1` varchar(50) DEFAULT NULL,
  `NAdd1` varchar(140) DEFAULT NULL,
  `NRel1` varchar(20) DEFAULT NULL,
  `NDob1` datetime DEFAULT NULL,
  `NShare1` decimal(18,2) DEFAULT NULL,
  `NGName1` varchar(50) DEFAULT NULL,
  `NName2` varchar(50) DEFAULT NULL,
  `NAdd2` varchar(140) DEFAULT NULL,
  `NRel2` varchar(20) DEFAULT NULL,
  `NDob2` datetime DEFAULT NULL,
  `NShare2` decimal(18,2) DEFAULT NULL,
  `NGName2` varchar(50) DEFAULT NULL,
  `NName3` varchar(50) DEFAULT NULL,
  `NAdd3` varchar(140) DEFAULT NULL,
  `NRel3` varchar(20) DEFAULT NULL,
  `NDob3` datetime DEFAULT NULL,
  `NShare3` decimal(18,2) DEFAULT NULL,
  `NGName3` varchar(50) DEFAULT NULL,
  `FName1` varchar(50) DEFAULT NULL,
  `FRel1` varchar(20) DEFAULT NULL,
  `FDOB1` datetime DEFAULT NULL,
  `FName2` varchar(50) DEFAULT NULL,
  `FRel2` varchar(20) DEFAULT NULL,
  `FDOB2` datetime DEFAULT NULL,
  `FName3` varchar(50) DEFAULT NULL,
  `FRel3` varchar(20) DEFAULT NULL,
  `FDOB3` datetime DEFAULT NULL,
  `FName4` varchar(50) DEFAULT NULL,
  `FRel4` varchar(20) DEFAULT NULL,
  `FDOB4` datetime DEFAULT NULL,
  `FName5` varchar(50) DEFAULT NULL,
  `FRel5` varchar(20) DEFAULT NULL,
  `FDOB5` datetime DEFAULT NULL,
  `FName6` varchar(50) DEFAULT NULL,
  `FRel6` varchar(20) DEFAULT NULL,
  `FDOB6` datetime DEFAULT NULL,
  `FName7` varchar(50) DEFAULT NULL,
  `FRel7` varchar(20) DEFAULT NULL,
  `FDOB7` datetime DEFAULT NULL,
  `FName8` varchar(50) DEFAULT NULL,
  `FRel8` varchar(20) DEFAULT NULL,
  `FDOB8` datetime DEFAULT NULL,
  `FName9` varchar(50) DEFAULT NULL,
  `FRel9` varchar(20) DEFAULT NULL,
  `FDOB9` datetime DEFAULT NULL,
  `FName10` varchar(50) DEFAULT NULL,
  `FRel10` varchar(20) DEFAULT NULL,
  `FDOB10` datetime DEFAULT NULL,
  `LLICNo` varchar(50) DEFAULT NULL,
  `LDOI` datetime DEFAULT NULL,
  `LIssFrm` varchar(50) DEFAULT NULL,
  `LVfrm` datetime DEFAULT NULL,
  `LVUpto` datetime DEFAULT NULL,
  `LVType` varchar(20) DEFAULT NULL,
  `LDOR` datetime DEFAULT NULL,
  `AppType` varchar(10) DEFAULT NULL,
  `Tranfrom` varchar(50) DEFAULT NULL,
  `LastPFNo` varchar(20) DEFAULT NULL,
  `BStop` int(11) DEFAULT NULL,
  `Library` bit(1) DEFAULT NULL,
  `AdmNo1` varchar(10) DEFAULT NULL,
  `AdmNo2` varchar(10) DEFAULT NULL,
  `AdmNo3` varchar(10) DEFAULT NULL,
  `AdmNo4` varchar(10) DEFAULT NULL,
  `AdmNo5` varchar(10) DEFAULT NULL,
  `BGroup` varchar(5) DEFAULT NULL,
  `VAdhoc` decimal(18,2) DEFAULT NULL,
  `NIncreDate` datetime DEFAULT NULL,
  `InsPol6` varchar(50) DEFAULT NULL,
  `PremAmt6` decimal(18,2) DEFAULT NULL,
  `INomi6` varchar(50) DEFAULT NULL,
  `InsPol7` varchar(50) DEFAULT NULL,
  `PremAmt7` decimal(18,2) DEFAULT NULL,
  `INomi7` varchar(50) DEFAULT NULL,
  `InsPol8` varchar(50) DEFAULT NULL,
  `PremAmt8` decimal(18,2) DEFAULT NULL,
  `INomi8` varchar(50) DEFAULT NULL,
  `LWP` smallint(6) DEFAULT NULL,
  `Grade_Pay` smallint(6) DEFAULT NULL,
  `PFPen` bit(1) DEFAULT NULL,
  `HRent` bit(1) DEFAULT NULL,
  `ESI_NO` varchar(20) DEFAULT NULL,
  `ESITF` bit(1) DEFAULT NULL,
  `PayType` bit(1) DEFAULT NULL,
  `IWH` bit(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `app_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_name` text NOT NULL,
  `class` varchar(25) NOT NULL,
  `email` text NOT NULL,
  `number` varchar(15) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `submit_date` date NOT NULL,
  `callback_msg` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `arrear`
--

CREATE TABLE `arrear` (
  `EMPID` varchar(6) DEFAULT NULL,
  `MONTH` double DEFAULT NULL,
  `YEAR` double DEFAULT NULL,
  `MTH_NAME` varchar(12) DEFAULT NULL,
  `YEAR_NAME` double DEFAULT NULL,
  `WORK_DAY` double DEFAULT NULL,
  `BASIC` double DEFAULT NULL,
  `DA` double DEFAULT NULL,
  `DP` double DEFAULT NULL,
  `CCA_PAID` double DEFAULT NULL,
  `DA_RATE_PD` double DEFAULT NULL,
  `BASIC_ARR` double DEFAULT NULL,
  `DA_ARR` double DEFAULT NULL,
  `DP_ARR` double DEFAULT NULL,
  `CCA_DUE` double DEFAULT NULL,
  `DA_RATE_DU` double DEFAULT NULL,
  `CCA_ARR` double DEFAULT NULL,
  `OTHER_ARR` double DEFAULT NULL,
  `HRA_PAID` double DEFAULT NULL,
  `HRA_DUE` double DEFAULT NULL,
  `pfAcNo` varchar(50) DEFAULT NULL,
  `f1` int(11) DEFAULT NULL,
  `f2` int(11) DEFAULT NULL,
  `PFA` int(11) DEFAULT NULL,
  `PENA` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `arrearvi`
--

CREATE TABLE `arrearvi` (
  `EMPID` varchar(6) DEFAULT NULL,
  `MONTH` double DEFAULT NULL,
  `YEAR` double DEFAULT NULL,
  `MTH_NAME` varchar(12) DEFAULT NULL,
  `YEAR_NAME` double DEFAULT NULL,
  `WORK_DAY` double DEFAULT NULL,
  `BASIC` double DEFAULT NULL,
  `Grade_Paid` double DEFAULT NULL,
  `DA` double DEFAULT NULL,
  `Transport` double DEFAULT NULL,
  `HRA_Paid` double DEFAULT NULL,
  `Med_Paid` smallint(6) DEFAULT NULL,
  `PaidDA` smallint(6) DEFAULT NULL,
  `BASIC_ARR` double DEFAULT NULL,
  `GRADE_ARR` int(11) DEFAULT NULL,
  `DA_ARR` double DEFAULT NULL,
  `TA_ARR` double DEFAULT NULL,
  `HRA_ARR` double DEFAULT NULL,
  `MED_ARR` double DEFAULT NULL,
  `DA_PAYABLE` double DEFAULT NULL,
  `ARREAR_AMT` double DEFAULT NULL,
  `PF_AMT` double DEFAULT NULL,
  `PEN_AMT` double DEFAULT NULL,
  `pfAcNo` varchar(50) DEFAULT NULL,
  `Adhoc` decimal(18,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `arrearvvi`
--

CREATE TABLE `arrearvvi` (
  `EMPID` varchar(6) DEFAULT NULL,
  `MONTH` double DEFAULT NULL,
  `YEAR` double DEFAULT NULL,
  `MTH_NAME` varchar(12) DEFAULT NULL,
  `YEAR_NAME` double DEFAULT NULL,
  `WORK_DAY` double DEFAULT NULL,
  `BASIC` double DEFAULT NULL,
  `Grade_Paid` double DEFAULT NULL,
  `DA` double DEFAULT NULL,
  `Transport` double DEFAULT NULL,
  `HRA_Paid` double DEFAULT NULL,
  `Med_Paid` smallint(6) DEFAULT NULL,
  `PaidDA` smallint(6) DEFAULT NULL,
  `BASIC_ARR` double DEFAULT NULL,
  `GRADE_ARR` int(11) DEFAULT NULL,
  `DA_ARR` double DEFAULT NULL,
  `TA_ARR` double DEFAULT NULL,
  `HRA_ARR` double DEFAULT NULL,
  `MED_ARR` double DEFAULT NULL,
  `DA_PAYABLE` double DEFAULT NULL,
  `ARREAR_AMT` double DEFAULT NULL,
  `PF_AMT` double DEFAULT NULL,
  `PEN_AMT` double DEFAULT NULL,
  `pfAcNo` varchar(50) DEFAULT NULL,
  `MNa` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `arr_head`
--

CREATE TABLE `arr_head` (
  `EMPID` varchar(6) DEFAULT NULL,
  `MONTH` double DEFAULT NULL,
  `YEAR` double DEFAULT NULL,
  `EFFECTIVE` datetime DEFAULT NULL,
  `APPROVED` datetime DEFAULT NULL,
  `SCALE` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_entry`
--

CREATE TABLE `attendance_entry` (
  `class_nm` varchar(255) DEFAULT NULL,
  `sec_nm` varchar(255) DEFAULT NULL,
  `admno` varchar(255) DEFAULT NULL,
  `snm` varchar(255) DEFAULT NULL,
  `roll` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `att_date` datetime DEFAULT NULL,
  `mnth` varchar(255) DEFAULT NULL,
  `Slno` int(11) DEFAULT NULL,
  `year_nm` int(11) DEFAULT NULL,
  `sel_one` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `att_temp_save`
--

CREATE TABLE `att_temp_save` (
  `id` int(11) NOT NULL,
  `admno` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `roll` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bank_master`
--

CREATE TABLE `bank_master` (
  `Bank_Code` int(11) DEFAULT NULL,
  `Bank_Name` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bonafide_certificate`
--

CREATE TABLE `bonafide_certificate` (
  `CERT_NO` varchar(255) DEFAULT NULL,
  `ADM_NO` varchar(15) DEFAULT NULL,
  `S_NAME` varchar(75) DEFAULT NULL,
  `F_NAME` varchar(50) DEFAULT NULL,
  `M_Name` varchar(25) DEFAULT NULL,
  `Adm_Date` datetime DEFAULT NULL,
  `End_DATE` datetime DEFAULT NULL,
  `class_name` varchar(25) DEFAULT NULL,
  `Issued_Date` datetime DEFAULT NULL,
  `duplcate_Issue` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `book_master`
--

CREATE TABLE `book_master` (
  `Stock_ID` int(11) DEFAULT NULL,
  `Book_Nm` varchar(255) DEFAULT NULL,
  `Publisher_Nm` varchar(255) DEFAULT NULL,
  `Class_Name` varchar(255) DEFAULT NULL,
  `Book_Price` double DEFAULT NULL,
  `Current_Stock` int(11) DEFAULT NULL,
  `Opening_Stock` int(11) DEFAULT NULL,
  `Entry_Date` datetime DEFAULT NULL,
  `Item_group_id` int(11) DEFAULT NULL,
  `measure` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `busnomaster`
--

CREATE TABLE `busnomaster` (
  `BusCode` double NOT NULL,
  `BusNo` varchar(255) DEFAULT NULL,
  `seats` double DEFAULT NULL,
  `regn_no` varchar(255) DEFAULT NULL,
  `chasis_no` varchar(255) DEFAULT NULL,
  `engine_no` varchar(255) DEFAULT NULL,
  `tax_paid_date` date DEFAULT NULL,
  `tax_expiry_date` date DEFAULT NULL,
  `fitness_date` date DEFAULT NULL,
  `fitness_renewal_date` date DEFAULT NULL,
  `gprs_installed` varchar(255) DEFAULT NULL,
  `pollution_date` date DEFAULT NULL,
  `pollution_expiry_date` date DEFAULT NULL,
  `insuance_comp_name` varchar(255) DEFAULT NULL,
  `insuance_comp_address` varchar(255) DEFAULT NULL,
  `insurance_policy_no` varchar(255) DEFAULT NULL,
  `insurance_amt` double DEFAULT NULL,
  `insurance_renewal_date` date DEFAULT NULL,
  `insurance_expiry_date` date DEFAULT NULL,
  `bus_no` double DEFAULT NULL,
  `cctv` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bus_incharge_master`
--

CREATE TABLE `bus_incharge_master` (
  `Incharge_Id` int(11) DEFAULT NULL,
  `Incharge_nm` varchar(255) DEFAULT NULL,
  `Incharge_ph_no` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bus_route_master`
--

CREATE TABLE `bus_route_master` (
  `Route_Id` int(11) DEFAULT NULL,
  `BusCode` int(11) DEFAULT NULL,
  `Trip_ID` int(11) DEFAULT NULL,
  `Prefer_ID` int(11) DEFAULT NULL,
  `STOPNO` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bus_trip_master`
--

CREATE TABLE `bus_trip_master` (
  `Trip_ID` int(11) DEFAULT NULL,
  `Trip_Nm` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `campus_master`
--

CREATE TABLE `campus_master` (
  `Campus_ID` int(11) NOT NULL,
  `Campus_Name` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `CAT_CODE` double DEFAULT NULL,
  `CAT_ABBR` varchar(15) DEFAULT NULL,
  `CAT_DESC` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `charcert`
--

CREATE TABLE `charcert` (
  `CERT_NO` mediumtext DEFAULT NULL,
  `ADM_NO` mediumtext DEFAULT NULL,
  `S_NAME` mediumtext DEFAULT NULL,
  `F_NAME` mediumtext DEFAULT NULL,
  `M_Name` mediumtext DEFAULT NULL,
  `Adm_Date` datetime DEFAULT NULL,
  `End_DATE` datetime DEFAULT NULL,
  `class_name` mediumtext DEFAULT NULL,
  `Issued_Date` datetime DEFAULT NULL,
  `duplcate_Issue` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cheque_entry`
--

CREATE TABLE `cheque_entry` (
  `PFDDNO` varchar(20) DEFAULT NULL,
  `PFDate` datetime DEFAULT NULL,
  `PFAmount` int(11) DEFAULT NULL,
  `PenDDNO` varchar(20) DEFAULT NULL,
  `PenDate` datetime DEFAULT NULL,
  `PenAmount` int(11) DEFAULT NULL,
  `GPFDDNO` varchar(20) DEFAULT NULL,
  `GPFDate` datetime DEFAULT NULL,
  `GPFAmount` int(11) DEFAULT NULL,
  `LEVDDNO` varchar(20) DEFAULT NULL,
  `LEVDate` datetime DEFAULT NULL,
  `LEVAmount` int(11) DEFAULT NULL,
  `EDLIDDNO` varchar(20) DEFAULT NULL,
  `EDLIDate` datetime DEFAULT NULL,
  `EDLIAmount` int(11) DEFAULT NULL,
  `MonthName` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `childhist`
--

CREATE TABLE `childhist` (
  `StId` varchar(50) DEFAULT NULL,
  `AdmNo` varchar(50) DEFAULT NULL,
  `Name1` varchar(50) DEFAULT NULL,
  `DOB1` date DEFAULT NULL,
  `Sex1` varchar(50) DEFAULT NULL,
  `Adm1` varchar(50) DEFAULT NULL,
  `Name2` varchar(50) DEFAULT NULL,
  `DOB2` date DEFAULT NULL,
  `Sex2` varchar(50) DEFAULT NULL,
  `Adm2` varchar(50) DEFAULT NULL,
  `Name3` varchar(50) DEFAULT NULL,
  `DOB3` date DEFAULT NULL,
  `Sex3` varchar(50) DEFAULT NULL,
  `Adm3` varchar(50) DEFAULT NULL,
  `Name4` varchar(50) DEFAULT NULL,
  `DOB4` date DEFAULT NULL,
  `Sex4` varchar(50) DEFAULT NULL,
  `Adm4` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `Class_No` int(11) NOT NULL,
  `CLASS_NM` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `class_section_wise_subject_allocation`
--

CREATE TABLE `class_section_wise_subject_allocation` (
  `ID` int(11) NOT NULL,
  `Class_Sec_SubCode` int(11) DEFAULT NULL,
  `Class_No` int(11) DEFAULT NULL,
  `section_no` int(11) DEFAULT NULL,
  `subject_code` int(11) DEFAULT NULL,
  `Total_Period_inWeek` int(11) DEFAULT NULL,
  `Subject_option` int(11) DEFAULT NULL,
  `Main_Teacher_Required` int(11) DEFAULT NULL,
  `Support_Teacher_Required` int(11) DEFAULT NULL,
  `Merged_WithSubCode` varchar(255) DEFAULT NULL,
  `Subject_Name_Dispaly` varchar(255) DEFAULT NULL,
  `Class_name_Roman` varchar(255) DEFAULT NULL,
  `Class_Name_Hindu_arabic` varchar(255) DEFAULT NULL,
  `Class_Display_Sorting` int(11) DEFAULT NULL,
  `Class_Sub_sorting` int(11) DEFAULT NULL,
  `Main_Teacher_Code` varchar(255) DEFAULT NULL,
  `Support_Teacher_Code` varchar(50) DEFAULT NULL,
  `Merge_Class_Status` int(11) DEFAULT NULL,
  `Merge_Class_Details` varchar(255) DEFAULT NULL,
  `Teacher_Merge_Class_Status` int(11) DEFAULT NULL,
  `Teacher_Merge_Class_Details` varchar(255) DEFAULT NULL,
  `AssignTotal_Period` int(11) DEFAULT NULL,
  `subj_nm` varchar(255) DEFAULT NULL,
  `opt_code` int(11) DEFAULT NULL,
  `sorting_no` int(11) DEFAULT NULL,
  `applicable_exam` int(11) DEFAULT NULL,
  `display_subnm_rp` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `co_scholastic`
--

CREATE TABLE `co_scholastic` (
  `SkillID` int(11) DEFAULT NULL,
  `SkillNm` mediumtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `co_scholastic_grade`
--

CREATE TABLE `co_scholastic_grade` (
  `Adm_no` mediumtext DEFAULT NULL,
  `Class` mediumtext DEFAULT NULL,
  `Sec` mediumtext DEFAULT NULL,
  `Term` int(11) DEFAULT NULL,
  `SkillCode` int(11) DEFAULT NULL,
  `Grade` mediumtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `daycoll`
--

CREATE TABLE `daycoll` (
  `RECT_NO` varchar(255) NOT NULL,
  `RECT_DATE` date DEFAULT NULL,
  `STU_NAME` varchar(255) DEFAULT NULL,
  `STUDENTID` varchar(255) DEFAULT NULL,
  `ADM_NO` varchar(250) DEFAULT NULL,
  `CLASS` varchar(25) DEFAULT NULL,
  `SEC` varchar(10) DEFAULT NULL,
  `ROLL_NO` double DEFAULT NULL,
  `PERIOD` varchar(255) DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  `Fee1` double DEFAULT NULL,
  `Fee2` double DEFAULT NULL,
  `Fee3` double DEFAULT NULL,
  `Fee4` double DEFAULT NULL,
  `Fee5` double DEFAULT NULL,
  `Fee6` double DEFAULT NULL,
  `Fee7` double DEFAULT NULL,
  `Fee8` double DEFAULT NULL,
  `Fee9` double DEFAULT NULL,
  `Fee10` double DEFAULT NULL,
  `Fee11` double DEFAULT NULL,
  `Fee12` double DEFAULT NULL,
  `Fee13` double DEFAULT NULL,
  `Fee14` double DEFAULT NULL,
  `Fee15` double DEFAULT NULL,
  `Fee16` double DEFAULT NULL,
  `Fee17` double DEFAULT NULL,
  `Fee18` double DEFAULT NULL,
  `Fee19` double DEFAULT NULL,
  `Fee20` double DEFAULT NULL,
  `Fee21` double DEFAULT NULL,
  `Fee22` double DEFAULT NULL,
  `Fee23` double DEFAULT NULL,
  `Fee24` double DEFAULT NULL,
  `Fee25` double DEFAULT NULL,
  `APR_FEE` varchar(255) DEFAULT NULL,
  `MAY_FEE` varchar(255) DEFAULT NULL,
  `JUNE_FEE` varchar(255) DEFAULT NULL,
  `JULY_FEE` varchar(255) DEFAULT NULL,
  `AUG_FEE` varchar(255) DEFAULT NULL,
  `SEP_FEE` varchar(255) DEFAULT NULL,
  `OCT_FEE` varchar(255) DEFAULT NULL,
  `NOV_FEE` varchar(255) DEFAULT NULL,
  `DEC_FEE` varchar(255) DEFAULT NULL,
  `JAN_FEE` varchar(255) DEFAULT NULL,
  `FEB_FEE` varchar(255) DEFAULT NULL,
  `MAR_FEE` varchar(255) DEFAULT NULL,
  `CHQ_NO` varchar(255) DEFAULT NULL,
  `Narr` varchar(255) DEFAULT NULL,
  `TAmt` double DEFAULT NULL,
  `Fee_Book_No` varchar(255) DEFAULT NULL,
  `Collection_Mode` int(11) DEFAULT NULL,
  `User_Id` varchar(255) DEFAULT NULL,
  `Payment_Mode` mediumtext NOT NULL,
  `Bank_Name` varchar(500) NOT NULL DEFAULT 'N/A',
  `Pay_Date` date NOT NULL DEFAULT current_timestamp(),
  `Session_Year` int(11) NOT NULL DEFAULT 2019,
  `FORM_NO` varchar(200) NOT NULL DEFAULT 'N/A',
  `voucher_created` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dbo_payslip`
--

CREATE TABLE `dbo_payslip` (
  `SCH_CODE` varchar(30) DEFAULT NULL,
  `EMPID` varchar(50) DEFAULT NULL,
  `EMPNAME` varchar(40) DEFAULT NULL,
  `CADRE` int(11) DEFAULT NULL,
  `PF_AC_NO` varchar(20) DEFAULT NULL,
  `PaySlip_Year` int(11) DEFAULT NULL,
  `P_MONTH` int(11) DEFAULT NULL,
  `PAY_DATE` datetime DEFAULT NULL,
  `WORK_DAY` int(11) DEFAULT NULL,
  `DAYS_WORK` int(11) DEFAULT NULL,
  `PAY_SCALE` varchar(50) DEFAULT NULL,
  `BASIC_PAY` int(11) DEFAULT NULL,
  `DEAR_ALW` int(11) DEFAULT NULL,
  `DEAR_PAY` int(11) DEFAULT NULL,
  `GRADE_PAY` int(11) DEFAULT NULL,
  `CITYC_ALW` int(11) DEFAULT NULL,
  `OTHER_ALW` int(11) DEFAULT NULL,
  `HRENT_ALW` int(11) DEFAULT NULL,
  `MED_ALW` int(11) DEFAULT NULL,
  `TEACH_ALW` int(11) DEFAULT NULL,
  `TRAV_ALW` int(11) DEFAULT NULL,
  `SPL_ALW` int(11) DEFAULT NULL,
  `MISC_ALW` int(11) DEFAULT NULL,
  `ARREAR` int(11) DEFAULT NULL,
  `PF_DED` int(11) DEFAULT NULL,
  `INSU_DED` int(11) DEFAULT NULL,
  `LOAN_DED` int(11) DEFAULT NULL,
  `ITAX_DED` int(11) DEFAULT NULL,
  `HRENT_DED` int(11) DEFAULT NULL,
  `MISC_DED` int(11) DEFAULT NULL,
  `STAFF_CAR` int(11) DEFAULT NULL,
  `OTHER_DED` int(11) DEFAULT NULL,
  `PTAX` int(11) DEFAULT NULL,
  `ESIE` int(11) DEFAULT NULL,
  `ESIO` int(11) DEFAULT NULL,
  `NET_PAY` int(11) DEFAULT NULL,
  `BASIC_RATE` int(11) DEFAULT NULL,
  `GRADE_RATE` int(11) DEFAULT NULL,
  `PF` int(11) DEFAULT NULL,
  `PEN` int(11) DEFAULT NULL,
  `Total_Pay` int(11) DEFAULT NULL,
  `Total_Deduction` int(11) DEFAULT NULL,
  `Leave_Encashment` int(11) DEFAULT NULL,
  `GratuityPoolFund` int(11) DEFAULT NULL,
  `EDLI` int(11) DEFAULT NULL,
  `Admin_Charge` int(11) DEFAULT NULL,
  `Gross_Salary` int(11) DEFAULT NULL,
  `Designation` varchar(255) DEFAULT NULL,
  `NatureOfApp` varchar(50) DEFAULT NULL,
  `Total_Alw` int(11) DEFAULT NULL,
  `Total4GPFReport` int(11) DEFAULT NULL,
  `F_Name` varchar(200) DEFAULT NULL,
  `DA_percent` int(11) DEFAULT NULL,
  `PayType` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `desig`
--

CREATE TABLE `desig` (
  `DESIG` varchar(20) DEFAULT NULL,
  `Sno` tinyint(4) NOT NULL,
  `print_position` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `discipline`
--

CREATE TABLE `discipline` (
  `SkillID` int(11) DEFAULT NULL,
  `SkillNm` mediumtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `discipline_grades`
--

CREATE TABLE `discipline_grades` (
  `Adm_No` mediumtext DEFAULT NULL,
  `Class` mediumtext DEFAULT NULL,
  `Sec` mediumtext DEFAULT NULL,
  `Term` int(11) DEFAULT NULL,
  `SkillCode` int(11) DEFAULT NULL,
  `Grade` mediumtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `dob_certificate`
--

CREATE TABLE `dob_certificate` (
  `CERT_NO` varchar(255) DEFAULT NULL,
  `ADM_NO` varchar(15) DEFAULT NULL,
  `S_NAME` varchar(75) DEFAULT NULL,
  `F_NAME` varchar(50) DEFAULT NULL,
  `M_Name` varchar(25) DEFAULT NULL,
  `Birth_Date` datetime DEFAULT NULL,
  `class_name` varchar(25) DEFAULT NULL,
  `Issued_Date` datetime DEFAULT NULL,
  `duplcate_Issue` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `driver_master`
--

CREATE TABLE `driver_master` (
  `Driver_ID` int(11) NOT NULL,
  `BusCode` int(11) DEFAULT NULL,
  `driver_empid` varchar(200) NOT NULL,
  `driver_name` varchar(200) DEFAULT NULL,
  `driver_address` varchar(200) DEFAULT NULL,
  `driver_dob` date DEFAULT NULL,
  `driver_ph_no` varchar(20) DEFAULT NULL,
  `driver_license_no` varchar(200) DEFAULT NULL,
  `trip_id` int(11) DEFAULT NULL,
  `khallasi_empid` varchar(200) NOT NULL,
  `khallasi_nm` varchar(200) DEFAULT NULL,
  `khallasi_ph_no` varchar(50) DEFAULT NULL,
  `incharge_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `EMPID` varchar(10) DEFAULT NULL,
  `EMP_FNAME` varchar(60) DEFAULT NULL,
  `EMP_MNAME` varchar(10) DEFAULT NULL,
  `EMP_LNAME` varchar(15) DEFAULT NULL,
  `D_O_J` date DEFAULT NULL,
  `D_O_B` date DEFAULT NULL,
  `SEX` varchar(50) DEFAULT NULL COMMENT '1=male 2=female 3=notallowed ',
  `DESIG` double DEFAULT NULL,
  `CADRE` double DEFAULT NULL,
  `BLOOD_GRP` varchar(3) DEFAULT NULL,
  `BASIC` double DEFAULT NULL,
  `DA_GRADE` double DEFAULT NULL,
  `D_O_PF` varchar(40) DEFAULT NULL,
  `P_ADD` varchar(255) DEFAULT NULL,
  `P_CITY` varchar(50) DEFAULT NULL,
  `P_STATE` varchar(50) DEFAULT NULL,
  `P_COUNTRY` varchar(50) DEFAULT NULL,
  `P_PIN` varchar(50) DEFAULT NULL,
  `P_PH1` varchar(50) DEFAULT NULL,
  `P_PH2` varchar(50) DEFAULT NULL,
  `P_FAX` varchar(50) DEFAULT NULL,
  `P_MOBILE` varchar(50) DEFAULT NULL,
  `P_EMAIL` varchar(50) DEFAULT NULL,
  `C_ADD` varchar(255) DEFAULT NULL,
  `C_CITY` varchar(50) DEFAULT NULL,
  `C_STATE` varchar(50) DEFAULT NULL,
  `C_COUNTRY` varchar(50) DEFAULT NULL,
  `C_PIN` varchar(50) DEFAULT NULL,
  `C_PH1` varchar(50) DEFAULT NULL,
  `C_PH2` varchar(50) DEFAULT NULL,
  `C_FAX` varchar(50) DEFAULT NULL,
  `C_MOBILE` varchar(50) DEFAULT NULL,
  `C_EMAIL` varchar(50) DEFAULT NULL,
  `PAY_SCALE` varchar(12) DEFAULT NULL,
  `PTAX` int(1) DEFAULT NULL,
  `AD_HOC` int(1) DEFAULT NULL,
  `N_INC_DATE` varchar(40) DEFAULT NULL,
  `PF_AC_NO` varchar(32) DEFAULT NULL,
  `PF_JOIN_DT` date DEFAULT NULL,
  `BANK_AC_NO` varchar(25) DEFAULT NULL,
  `INS_POLNO` varchar(22) DEFAULT NULL,
  `NOMINEE1` varchar(100) DEFAULT NULL,
  `PAN_NUMBER` varchar(12) DEFAULT NULL,
  `CAS_LEAVE` double DEFAULT NULL,
  `LOAN_ID` varchar(6) DEFAULT NULL,
  `D_O_SUANN` varchar(40) DEFAULT NULL,
  `MAR_STAT` varchar(50) DEFAULT NULL,
  `G_NAME` varchar(30) DEFAULT NULL,
  `EL` double DEFAULT NULL,
  `ADVANCE` double DEFAULT NULL,
  `FRESH` bit(1) DEFAULT NULL,
  `TRANS_FROM` varchar(60) DEFAULT NULL,
  `LAST_PFNO` varchar(30) DEFAULT NULL,
  `VAdhoc` int(11) DEFAULT NULL,
  `ESI_AC_NO` varchar(25) DEFAULT NULL,
  `ESI_APP` int(1) DEFAULT 0,
  `GRADEPAY` double DEFAULT NULL,
  `PF_APP` int(1) DEFAULT 0,
  `UANNO` varchar(12) DEFAULT NULL,
  `AADHAARNO` varchar(12) DEFAULT NULL,
  `PANCARD` varchar(10) DEFAULT NULL,
  `COMPID` int(11) DEFAULT NULL,
  `EMPLOYEEID` varchar(15) DEFAULT NULL,
  `CTC` double DEFAULT NULL,
  `QUAL` double DEFAULT NULL,
  `MASTERQUAL` double DEFAULT NULL,
  `PROFQUAL` varchar(255) DEFAULT NULL,
  `JOINDTTYPE` varchar(1) DEFAULT NULL,
  `RELATIONTYPE` varchar(1) DEFAULT NULL,
  `WORKEXP` varchar(50) DEFAULT NULL,
  `INITIALS` varchar(255) DEFAULT NULL,
  `FATHERS_NAME` varchar(2555) DEFAULT NULL,
  `EMP_TYPE` varchar(255) DEFAULT NULL,
  `STAFF_TYPE` varchar(255) DEFAULT NULL COMMENT '1=teaching,2=non-teaching',
  `TEACHER_TYPE` varchar(20) DEFAULT NULL,
  `HRA_APP` int(1) DEFAULT 0,
  `EPS_AC_NO` varchar(255) DEFAULT NULL,
  `TA_ALLOWANCE_APP` int(1) DEFAULT 0,
  `TA_SLAB` int(11) DEFAULT 0,
  `QUATER_NO` varchar(255) DEFAULT NULL,
  `QUATER_TYPE` varchar(255) DEFAULT NULL,
  `QUATER_AREA` int(11) DEFAULT NULL,
  `QUARTER_RENT` float(10,2) DEFAULT NULL,
  `SECOND_SHIFT_ALLOW` int(1) DEFAULT 0,
  `SPECIAL_ALLOW` int(1) DEFAULT NULL,
  `GROUP_INS_POLI` int(1) DEFAULT NULL,
  `CONTRACT_TYPE` varchar(255) DEFAULT NULL,
  `LEVEL_NO` int(11) DEFAULT NULL,
  `LEVEL_YEAR` int(11) DEFAULT NULL,
  `ML` int(11) DEFAULT NULL,
  `SHIFT` varchar(255) DEFAULT NULL,
  `ROLE_ID` int(11) NOT NULL,
  `WING_MASTER_ID` int(11) NOT NULL,
  `EMP_LEVEL` int(11) DEFAULT NULL,
  `VPF` float(10,2) DEFAULT NULL,
  `CATEGORY` varchar(25) NOT NULL,
  `STATUS` int(11) NOT NULL DEFAULT 1 COMMENT 'status code comes from library',
  `DATE_OF_SEPARATION` date DEFAULT NULL,
  `profile_img` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `employee_lic`
--

CREATE TABLE `employee_lic` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `policyno1` varchar(255) DEFAULT NULL,
  `premium_amt_1` float(10,2) DEFAULT NULL,
  `nominee1` varchar(255) DEFAULT NULL,
  `policyno2` varchar(255) DEFAULT NULL,
  `premium_amt_2` float(10,2) DEFAULT NULL,
  `nominee2` varchar(255) DEFAULT NULL,
  `policyno3` varchar(255) DEFAULT NULL,
  `premium_amt_3` float(10,2) DEFAULT NULL,
  `nominee3` varchar(255) DEFAULT NULL,
  `policyno4` varchar(255) DEFAULT NULL,
  `premium_amt_4` float(10,2) DEFAULT NULL,
  `nominee4` varchar(255) DEFAULT NULL,
  `policyno5` varchar(255) DEFAULT NULL,
  `premium_amt_5` float(10,2) DEFAULT NULL,
  `nominee5` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emp_applied_leave_history`
--

CREATE TABLE `emp_applied_leave_history` (
  `ID` int(11) NOT NULL,
  `EMPLOYEE_ID` varchar(255) DEFAULT NULL,
  `APPLY_DATE` timestamp NULL DEFAULT current_timestamp(),
  `DAY_TYPE` int(11) NOT NULL DEFAULT 1 COMMENT '1 = FULL DAY, 2 = HALF DAY',
  `LEAVE_TYPE` int(11) DEFAULT NULL,
  `APPLIED_LEAVE_TYPE` int(11) DEFAULT NULL,
  `DATE_FROM` date DEFAULT NULL,
  `DATE_TO` date DEFAULT NULL,
  `AGAINST_DATE_FROM` date DEFAULT NULL,
  `AGAINST_DATE_TO` date DEFAULT NULL,
  `TOTAL_DAYS` float(10,2) NOT NULL,
  `REASON` text DEFAULT NULL,
  `REASON_DETAILS` text DEFAULT NULL,
  `DOCUMENT` text DEFAULT NULL,
  `STATUS` int(11) NOT NULL COMMENT '0 = PENDING, 1 = APPROVED, 2 = DISAPPROVED',
  `ADMIN_ID` varchar(255) DEFAULT NULL,
  `REMARKS` text DEFAULT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `MANUAL_ADMIN_ID` varchar(255) NOT NULL DEFAULT '0',
  `UPDATE_LOCK` int(11) NOT NULL DEFAULT 0 COMMENT '0 = No, 1 = Yes',
  `UPDATED_AT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emp_attendance`
--

CREATE TABLE `emp_attendance` (
  `ID` int(11) NOT NULL,
  `EMPLOYEE_ID` int(11) NOT NULL,
  `IN_TIME` timestamp NULL DEFAULT NULL,
  `IN_CHECK_DIFFER` time DEFAULT NULL,
  `IN_TIME_REMARKS` text DEFAULT NULL,
  `OUT_TIME` timestamp NULL DEFAULT NULL,
  `OUT_CHECK_DIFFER` time DEFAULT NULL,
  `OUT_TIME_REMARKS` text DEFAULT NULL,
  `SHIFT_MASTER_ID` int(11) DEFAULT NULL,
  `SHIFT_IN_TIME` time DEFAULT NULL,
  `SHIFT_OUT_TIME` time DEFAULT NULL,
  `SHIFT_DURATION` time DEFAULT NULL,
  `MIN_HRS_FULL` time DEFAULT NULL,
  `MIN_HRS_HALF` time DEFAULT NULL,
  `TOTAL_DURATION` time DEFAULT NULL,
  `ATTEN_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `STATUS` int(11) NOT NULL DEFAULT 1 COMMENT '1 = IN, 2 = OUT',
  `PUNCH_TYPE` int(11) NOT NULL COMMENT '0 = MACHINE, 1 = MANUAL',
  `ADMIN_ID` varchar(255) NOT NULL DEFAULT '0' COMMENT '0 = MACHINE',
  `REMARKS` text DEFAULT NULL,
  `UPDATE_LOCK` int(11) NOT NULL DEFAULT 0 COMMENT '0 = No, 1 = Yes',
  `UPDATED_AT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emp_leave_attendance`
--

CREATE TABLE `emp_leave_attendance` (
  `ID` int(11) NOT NULL,
  `EMPLOYEE_ID` varchar(255) DEFAULT NULL,
  `APPLY_DATE` date DEFAULT NULL,
  `LEAVE_TYPE` int(11) DEFAULT NULL,
  `APPLIED_LEAVE_TYPE` int(11) DEFAULT NULL,
  `DATE_FROM` date DEFAULT NULL,
  `DATE_TO` date DEFAULT NULL,
  `AGAINST_DATE_FROM` date NOT NULL,
  `AGAINST_DATE_TO` date NOT NULL,
  `TOTAL_DAYS` int(11) NOT NULL,
  `REASON` text DEFAULT NULL,
  `REASON_DETAILS` text DEFAULT NULL,
  `DOCUMENT` text DEFAULT NULL,
  `STATUS` int(11) NOT NULL COMMENT '0 = PENDING, 1 = APPROVED, 2 = DISAPPROVED',
  `ADMIN_ID` varchar(255) DEFAULT NULL,
  `REMARKS` text DEFAULT NULL,
  `CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  `MANUAL_ADMIN_ID` varchar(255) NOT NULL DEFAULT '0',
  `UPDATE_LOCK` int(11) NOT NULL DEFAULT 0 COMMENT '0 = No, 1 = Yes',
  `UPDATED_AT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emp_leave_history`
--

CREATE TABLE `emp_leave_history` (
  `ID` int(11) NOT NULL,
  `EMP_LEAVE_ATTENDANCE_ID` int(11) NOT NULL,
  `LEAVE_TYPE` int(11) NOT NULL,
  `STATUS` int(11) DEFAULT NULL COMMENT '0 = PENDING, 1 = APPROVED, 2 = DISAPPROVED',
  `REMARKS` text DEFAULT NULL,
  `ADMIN_ID` varchar(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emp_separation_log`
--

CREATE TABLE `emp_separation_log` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(25) NOT NULL,
  `joining_date` date NOT NULL,
  `separation_date` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `eward`
--

CREATE TABLE `eward` (
  `HOUSENO` double NOT NULL,
  `HOUSENAME` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `exammaster`
--

CREATE TABLE `exammaster` (
  `ExamCode` tinyint(4) DEFAULT NULL,
  `ExamName` varchar(20) DEFAULT NULL,
  `wetage1` varchar(255) DEFAULT NULL,
  `wetage2` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feegeneration`
--

CREATE TABLE `feegeneration` (
  `Month_NM` varchar(50) DEFAULT NULL,
  `STU_NAME` varchar(75) DEFAULT NULL,
  `STUDENTID` varchar(100) DEFAULT NULL,
  `ADM_NO` varchar(15) DEFAULT NULL,
  `CLASS` varchar(25) DEFAULT NULL,
  `SEC` varchar(10) DEFAULT NULL,
  `ROLL_NO` double DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  `Fee1` double DEFAULT NULL,
  `Fee2` double DEFAULT NULL,
  `Fee3` double DEFAULT NULL,
  `Fee4` double DEFAULT NULL,
  `Fee5` double DEFAULT NULL,
  `Fee6` double DEFAULT NULL,
  `Fee7` double DEFAULT NULL,
  `Fee8` double DEFAULT NULL,
  `Fee9` double DEFAULT NULL,
  `Fee10` double DEFAULT NULL,
  `Fee11` double DEFAULT NULL,
  `Fee12` double DEFAULT NULL,
  `Fee13` double DEFAULT NULL,
  `Fee14` double DEFAULT NULL,
  `Fee15` double DEFAULT NULL,
  `Fee16` double DEFAULT NULL,
  `Fee17` double DEFAULT NULL,
  `Fee18` double DEFAULT NULL,
  `Fee19` double DEFAULT NULL,
  `Fee20` double DEFAULT NULL,
  `Fee21` double DEFAULT NULL,
  `Fee22` double DEFAULT NULL,
  `Fee23` double DEFAULT NULL,
  `Fee24` double DEFAULT NULL,
  `Fee25` double DEFAULT NULL,
  `Fee_details` varchar(100) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feegeneration_2324`
--

CREATE TABLE `feegeneration_2324` (
  `Month_NM` varchar(50) DEFAULT NULL,
  `STU_NAME` varchar(75) DEFAULT NULL,
  `STUDENTID` varchar(100) DEFAULT NULL,
  `ADM_NO` varchar(15) DEFAULT NULL,
  `CLASS` varchar(25) DEFAULT NULL,
  `SEC` varchar(10) DEFAULT NULL,
  `ROLL_NO` double DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  `Fee1` double DEFAULT NULL,
  `Fee2` double DEFAULT NULL,
  `Fee3` double DEFAULT NULL,
  `Fee4` double DEFAULT NULL,
  `Fee5` double DEFAULT NULL,
  `Fee6` double DEFAULT NULL,
  `Fee7` double DEFAULT NULL,
  `Fee8` double DEFAULT NULL,
  `Fee9` double DEFAULT NULL,
  `Fee10` double DEFAULT NULL,
  `Fee11` double DEFAULT NULL,
  `Fee12` double DEFAULT NULL,
  `Fee13` double DEFAULT NULL,
  `Fee14` double DEFAULT NULL,
  `Fee15` double DEFAULT NULL,
  `Fee16` double DEFAULT NULL,
  `Fee17` double DEFAULT NULL,
  `Fee18` double DEFAULT NULL,
  `Fee19` double DEFAULT NULL,
  `Fee20` double DEFAULT NULL,
  `Fee21` double DEFAULT NULL,
  `Fee22` double DEFAULT NULL,
  `Fee23` double DEFAULT NULL,
  `Fee24` double DEFAULT NULL,
  `Fee25` double DEFAULT NULL,
  `Fee_details` varchar(100) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feegeneration_bak_04092023`
--

CREATE TABLE `feegeneration_bak_04092023` (
  `Month_NM` varchar(50) DEFAULT NULL,
  `STU_NAME` varchar(75) DEFAULT NULL,
  `STUDENTID` varchar(100) DEFAULT NULL,
  `ADM_NO` varchar(15) DEFAULT NULL,
  `CLASS` varchar(15) DEFAULT NULL,
  `SEC` varchar(10) DEFAULT NULL,
  `ROLL_NO` double DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  `Fee1` double DEFAULT NULL,
  `Fee2` double DEFAULT NULL,
  `Fee3` double DEFAULT NULL,
  `Fee4` double DEFAULT NULL,
  `Fee5` double DEFAULT NULL,
  `Fee6` double DEFAULT NULL,
  `Fee7` double DEFAULT NULL,
  `Fee8` double DEFAULT NULL,
  `Fee9` double DEFAULT NULL,
  `Fee10` double DEFAULT NULL,
  `Fee11` double DEFAULT NULL,
  `Fee12` double DEFAULT NULL,
  `Fee13` double DEFAULT NULL,
  `Fee14` double DEFAULT NULL,
  `Fee15` double DEFAULT NULL,
  `Fee16` double DEFAULT NULL,
  `Fee17` double DEFAULT NULL,
  `Fee18` double DEFAULT NULL,
  `Fee19` double DEFAULT NULL,
  `Fee20` double DEFAULT NULL,
  `Fee21` double DEFAULT NULL,
  `Fee22` double DEFAULT NULL,
  `Fee23` double DEFAULT NULL,
  `Fee24` double DEFAULT NULL,
  `Fee25` double DEFAULT NULL,
  `Fee_details` varchar(100) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feegeneration_old`
--

CREATE TABLE `feegeneration_old` (
  `Month_NM` varchar(50) DEFAULT NULL,
  `STU_NAME` varchar(75) DEFAULT NULL,
  `STUDENTID` varchar(100) DEFAULT NULL,
  `ADM_NO` varchar(15) DEFAULT NULL,
  `CLASS` varchar(15) DEFAULT NULL,
  `SEC` varchar(10) DEFAULT NULL,
  `ROLL_NO` double DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  `Fee1` double DEFAULT NULL,
  `Fee2` double DEFAULT NULL,
  `Fee3` double DEFAULT NULL,
  `Fee4` double DEFAULT NULL,
  `Fee5` double DEFAULT NULL,
  `Fee6` double DEFAULT NULL,
  `Fee7` double DEFAULT NULL,
  `Fee8` double DEFAULT NULL,
  `Fee9` double DEFAULT NULL,
  `Fee10` double DEFAULT NULL,
  `Fee11` double DEFAULT NULL,
  `Fee12` double DEFAULT NULL,
  `Fee13` double DEFAULT NULL,
  `Fee14` double DEFAULT NULL,
  `Fee15` double DEFAULT NULL,
  `Fee16` double DEFAULT NULL,
  `Fee17` double DEFAULT NULL,
  `Fee18` double DEFAULT NULL,
  `Fee19` double DEFAULT NULL,
  `Fee20` double DEFAULT NULL,
  `Fee21` double DEFAULT NULL,
  `Fee22` double DEFAULT NULL,
  `Fee23` double DEFAULT NULL,
  `Fee24` double DEFAULT NULL,
  `Fee25` double DEFAULT NULL,
  `Fee_details` varchar(100) DEFAULT NULL,
  `id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `feehead`
--

CREATE TABLE `feehead` (
  `ACT_CODE` smallint(6) NOT NULL DEFAULT 0,
  `FEE_HEAD` varchar(50) DEFAULT NULL,
  `MONTHLY` smallint(6) DEFAULT NULL,
  `CL_BASED` smallint(6) DEFAULT NULL,
  `AMOUNT` double DEFAULT NULL,
  `SHNAME` varchar(35) DEFAULT NULL,
  `EMP` double DEFAULT NULL,
  `CCL` double DEFAULT NULL,
  `SPL` double DEFAULT NULL,
  `EXT` double DEFAULT NULL,
  `INTERNAL` double DEFAULT NULL,
  `AccG` smallint(6) DEFAULT NULL,
  `HType` varchar(50) DEFAULT NULL,
  `APR` smallint(6) DEFAULT NULL,
  `may` smallint(6) DEFAULT NULL,
  `JUN` smallint(6) DEFAULT NULL,
  `JUL` smallint(6) DEFAULT NULL,
  `AUG` smallint(6) DEFAULT NULL,
  `SEP` smallint(6) DEFAULT NULL,
  `OCT` smallint(6) DEFAULT NULL,
  `NOV` smallint(6) DEFAULT NULL,
  `DECM` smallint(6) DEFAULT NULL,
  `JAN` smallint(6) DEFAULT NULL,
  `FEB` smallint(6) DEFAULT NULL,
  `MAR` smallint(6) DEFAULT NULL,
  `Annual` smallint(6) DEFAULT NULL COMMENT '2=AMOUNT WILL BE NOT TAKE FOR NEW STUDENT MONTH COLLECTION,3=FOR FORM SALES TIME AMOUNT WILL BE TAKEN',
  `LEDGER_NO` varchar(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fee_clw`
--

CREATE TABLE `fee_clw` (
  `CL` smallint(6) DEFAULT NULL,
  `FH` smallint(6) DEFAULT NULL,
  `AMOUNT` double DEFAULT NULL,
  `EMP` double DEFAULT NULL,
  `CCL` double DEFAULT NULL,
  `SPL` double DEFAULT NULL,
  `EXT` double DEFAULT NULL,
  `INTERNAL` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `fee_head_locking`
--

CREATE TABLE `fee_head_locking` (
  `ID` int(11) DEFAULT NULL,
  `Check_On` bit(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `grademaster`
--

CREATE TABLE `grademaster` (
  `ORange` double DEFAULT NULL,
  `CRange` double DEFAULT NULL,
  `Grade` mediumtext DEFAULT NULL,
  `Qualitative_Norms` mediumtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `head_type`
--

CREATE TABLE `head_type` (
  `id` int(11) NOT NULL,
  `head_name` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `holiday_master`
--

CREATE TABLE `holiday_master` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) DEFAULT NULL,
  `DAY_TYPE` int(11) DEFAULT NULL COMMENT '1 = SINGLE DAY, 2 = MUTLIPLE DAY',
  `FROM_DATE` date DEFAULT NULL,
  `TO_DATE` date DEFAULT NULL,
  `APPLIED_FOR` int(11) NOT NULL COMMENT '0 = ALL, 1 = EMPLOYEE, 2 = STUDENT',
  `CLASS_ID` int(11) NOT NULL COMMENT '0 = ALL CLASSES',
  `UPDATE_LOCK` int(11) NOT NULL DEFAULT 0 COMMENT '0 = No, 1 = Yes',
  `UPDATED_AT` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE `homework` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(255) NOT NULL,
  `subject` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `homework_date` date DEFAULT NULL,
  `submission_date` date DEFAULT NULL,
  `class` int(11) NOT NULL,
  `sec` int(11) NOT NULL,
  `homework_category` int(11) NOT NULL,
  `remarks` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `img` text NOT NULL,
  `is_allstu` int(11) NOT NULL COMMENT '1=all students,0=particular_student'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homework_adm_wise`
--

CREATE TABLE `homework_adm_wise` (
  `id` int(11) NOT NULL,
  `homework_tbl_id` int(11) NOT NULL,
  `admno` varchar(255) NOT NULL,
  `homework_status` varchar(2) NOT NULL DEFAULT 'N' COMMENT 'Y=completed,N=incomplete',
  `teacher_remarks` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homework_cat_master`
--

CREATE TABLE `homework_cat_master` (
  `id` int(11) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `house`
--

CREATE TABLE `house` (
  `HOUSENO` double DEFAULT NULL,
  `HOUSENAME` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `latefine_master`
--

CREATE TABLE `latefine_master` (
  `ID` int(11) NOT NULL,
  `month_applied` int(11) NOT NULL,
  `date_applied` int(11) NOT NULL,
  `late_amount` int(11) NOT NULL,
  `collection_mode` int(11) NOT NULL COMMENT '1=monthly_fine,2=daily_fine',
  `status` int(11) NOT NULL COMMENT '1=actice,0=unactive'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `latest_news`
--

CREATE TABLE `latest_news` (
  `id` int(100) NOT NULL,
  `news` text DEFAULT NULL,
  `status` varchar(100) NOT NULL DEFAULT 'Y',
  `created_date` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `leave_master`
--

CREATE TABLE `leave_master` (
  `id` int(100) NOT NULL,
  `name` varchar(500) NOT NULL,
  `applicable_for` varchar(500) NOT NULL,
  `no_days` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `username` varchar(255) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `pass_word` varchar(100) NOT NULL,
  `emp_name` varchar(100) NOT NULL,
  `user_type` varchar(100) DEFAULT NULL,
  `user_level` varchar(100) DEFAULT NULL,
  `fees` int(100) NOT NULL,
  `contenmng` int(100) NOT NULL,
  `EXAM` int(100) NOT NULL,
  `ATTENDANCE` int(100) NOT NULL,
  `DISCIPLINE` int(100) NOT NULL,
  `ACTIVITY` int(100) NOT NULL,
  `TIME_TABLE` int(100) NOT NULL,
  `LIBRARYmng` int(100) NOT NULL,
  `PAYROLL` int(100) NOT NULL,
  `ACCOUNTS` int(100) NOT NULL,
  `INVENTORY` int(100) NOT NULL,
  `TRANSPORT` int(100) NOT NULL,
  `HEALTH` int(100) NOT NULL,
  `CALLCENTER` int(100) NOT NULL,
  `MASTER_DATABASE` int(100) NOT NULL,
  `MAC_ADDRESS` varchar(200) NOT NULL,
  `login_status` int(100) NOT NULL,
  `login_mode` varchar(100) NOT NULL,
  `Add_Provision` int(100) NOT NULL,
  `Modify_Provision` int(100) NOT NULL,
  `Del_Provision` int(100) NOT NULL,
  `cancel_Provision` int(11) NOT NULL,
  `Mob_No` int(20) NOT NULL,
  `DOB` date NOT NULL,
  `user_address` varchar(1000) NOT NULL,
  `emailid` varchar(200) NOT NULL,
  `Security_Ques` varchar(1000) NOT NULL,
  `Security_Ans` varchar(1000) NOT NULL,
  `Activation_date` date NOT NULL,
  `Deactivation_Date` date NOT NULL,
  `Class_tech_sts` int(100) NOT NULL COMMENT '1=class_teacher,0=teacher',
  `Class_No` int(100) NOT NULL,
  `Section_No` int(100) NOT NULL,
  `ROLE_ID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `admno` varchar(25) DEFAULT NULL,
  `ExamC` int(11) DEFAULT NULL,
  `SCode` double DEFAULT NULL,
  `M1` double DEFAULT NULL,
  `M2` varchar(15) DEFAULT NULL,
  `M3` double DEFAULT NULL,
  `Classes` varchar(25) DEFAULT NULL,
  `Sec` varchar(25) DEFAULT NULL,
  `EDate` datetime DEFAULT NULL,
  `MA2` double DEFAULT NULL,
  `Term` varchar(50) DEFAULT NULL,
  `grade` varchar(50) DEFAULT NULL,
  `Teacher_code` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `master`
--

CREATE TABLE `master` (
  `CounterNo` mediumtext DEFAULT NULL,
  `ReceiptNo` int(11) DEFAULT NULL,
  `Collection_Type` int(11) DEFAULT NULL COMMENT '1=counter collection,2=sunil_enterprises_collection,3=bachpan and none collection without alphabet rect',
  `User_ID` mediumtext DEFAULT NULL,
  `Student_ID` mediumtext DEFAULT NULL,
  `Adm_no` int(11) DEFAULT NULL,
  `login_status` int(11) NOT NULL DEFAULT 0,
  `id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `masterpf`
--

CREATE TABLE `masterpf` (
  `id` int(11) NOT NULL,
  `ST_DATE` varchar(40) DEFAULT NULL,
  `OWN_RATE` double DEFAULT NULL,
  `EMP_RATE` double DEFAULT NULL,
  `PEN_RATE` double DEFAULT NULL,
  `PAY_LIMIT` double DEFAULT NULL,
  `HRA_Rate` int(11) DEFAULT NULL,
  `ESI_OWN_RATE` double DEFAULT NULL,
  `ESI_EMP_RATE` double DEFAULT NULL,
  `ESI_LIMIT` int(11) DEFAULT NULL,
  `ESI_Applied` bit(1) DEFAULT NULL,
  `PTAX_Applied` bit(1) DEFAULT NULL,
  `Pay_Limit_Applied` bit(1) DEFAULT NULL,
  `BED_Alow` double DEFAULT NULL,
  `da_rate` int(100) NOT NULL,
  `ta_rate_slab1` int(100) NOT NULL,
  `ta_rate_slab2` int(100) NOT NULL,
  `ta_rate_slab3` int(100) NOT NULL,
  `special_allowance` int(100) NOT NULL,
  `fpf` int(100) NOT NULL,
  `vpf` int(100) NOT NULL,
  `staff_welfare_fund` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `maxmarks`
--

CREATE TABLE `maxmarks` (
  `ExamCode` tinyint(4) DEFAULT NULL,
  `ExamMode` double DEFAULT NULL,
  `MaxMarks` int(4) DEFAULT NULL,
  `ClassCode` tinyint(4) DEFAULT NULL,
  `Term` varchar(255) DEFAULT NULL,
  `teacher_code` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mempmthatt`
--

CREATE TABLE `mempmthatt` (
  `SNo` int(11) DEFAULT NULL,
  `EID` varchar(50) DEFAULT NULL,
  `Jan` double DEFAULT NULL,
  `Feb` double DEFAULT NULL,
  `Mar` double DEFAULT NULL,
  `Apr` double DEFAULT NULL,
  `May` double DEFAULT NULL,
  `Jun` double DEFAULT NULL,
  `Jul` double DEFAULT NULL,
  `Aug` double DEFAULT NULL,
  `Sep` double DEFAULT NULL,
  `Oct` double DEFAULT NULL,
  `Nov` double DEFAULT NULL,
  `Dec` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `menu_data_role`
--

CREATE TABLE `menu_data_role` (
  `ID` int(11) NOT NULL,
  `S_NO` float(10,2) NOT NULL,
  `MODULE` varchar(255) DEFAULT NULL,
  `MENU_NAME` varchar(255) DEFAULT NULL,
  `CAN_ADD` varchar(255) DEFAULT NULL,
  `CAN_EDIT` varchar(255) DEFAULT NULL,
  `CAN_DELETE` varchar(255) DEFAULT NULL,
  `CAN_VIEW` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `misc_password`
--

CREATE TABLE `misc_password` (
  `id` int(11) NOT NULL,
  `username` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `misc_table`
--

CREATE TABLE `misc_table` (
  `Class_Wise_Sub` mediumtext DEFAULT NULL,
  `Sch_Set` mediumtext DEFAULT NULL,
  `Marks_Entry_Permission` mediumtext DEFAULT NULL,
  `EXAM_TYPE` mediumtext DEFAULT NULL,
  `Aadhar_Card` mediumtext DEFAULT NULL,
  `Cross_List_IX` mediumtext DEFAULT NULL,
  `adm_no` mediumtext DEFAULT NULL,
  `studentid` mediumtext DEFAULT NULL,
  `chartno` mediumtext DEFAULT NULL,
  `bonano` mediumtext DEFAULT NULL,
  `dobno` mediumtext DEFAULT NULL,
  `tcno` mediumtext DEFAULT NULL,
  `Current_Year` mediumtext DEFAULT NULL,
  `FeeType` smallint(6) DEFAULT NULL,
  `MasterLedger` int(11) DEFAULT NULL,
  `tchead` mediumtext DEFAULT NULL,
  `Tution_fee_Head` int(11) DEFAULT NULL,
  `Caution_Money` int(11) DEFAULT NULL,
  `User_Allocation_Mode` int(11) DEFAULT NULL,
  `report_card_type` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mledger`
--

CREATE TABLE `mledger` (
  `CCode` varchar(120) DEFAULT NULL,
  `ODate` timestamp NULL DEFAULT current_timestamp(),
  `OBal` decimal(18,2) DEFAULT NULL,
  `CBO` varchar(50) DEFAULT NULL,
  `DC` varchar(50) DEFAULT NULL,
  `SG` int(11) DEFAULT NULL,
  `ANSWER` int(11) DEFAULT NULL,
  `AcNo` int(11) NOT NULL,
  `LedgerNo` varchar(15) DEFAULT NULL,
  `BAmount` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `monthly_emp_attend_gen`
--

CREATE TABLE `monthly_emp_attend_gen` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `shift_id` int(11) NOT NULL,
  `total_working_days` int(11) DEFAULT NULL,
  `total_present` float(10,2) DEFAULT NULL,
  `total_absent` float(10,2) DEFAULT NULL,
  `1c` varchar(255) DEFAULT NULL COMMENT 'P = Present, H = Holiday, HF = Half Day, CL = Casual Leave, ML = Medical Leave, EL = Earned Leave, LWP = Leave Without Pay, AB = Absent, ELW = Early leave from work',
  `2c` varchar(255) DEFAULT NULL,
  `3c` varchar(255) DEFAULT NULL,
  `4c` varchar(255) DEFAULT NULL,
  `5c` varchar(255) DEFAULT NULL,
  `6c` varchar(255) DEFAULT NULL,
  `7c` varchar(255) DEFAULT NULL,
  `8c` varchar(255) DEFAULT NULL,
  `9c` varchar(255) DEFAULT NULL,
  `10c` varchar(255) DEFAULT NULL,
  `11c` varchar(255) DEFAULT NULL,
  `12c` varchar(255) DEFAULT NULL,
  `13c` varchar(255) DEFAULT NULL,
  `14c` varchar(255) DEFAULT NULL,
  `15c` varchar(255) DEFAULT NULL,
  `16c` varchar(255) DEFAULT NULL,
  `17c` varchar(255) DEFAULT NULL,
  `18c` varchar(255) DEFAULT NULL,
  `19c` varchar(255) DEFAULT NULL,
  `20c` varchar(255) DEFAULT NULL,
  `21c` varchar(255) DEFAULT NULL,
  `22c` varchar(255) DEFAULT NULL,
  `23c` varchar(255) DEFAULT NULL,
  `24c` varchar(255) DEFAULT NULL,
  `25c` varchar(255) DEFAULT NULL,
  `26c` varchar(255) DEFAULT NULL,
  `27c` varchar(255) DEFAULT NULL,
  `28c` varchar(255) DEFAULT NULL,
  `29c` varchar(255) DEFAULT NULL,
  `30c` varchar(255) DEFAULT NULL,
  `31c` varchar(255) DEFAULT NULL,
  `payslip_generated` int(11) NOT NULL DEFAULT 0 COMMENT '0 = No, 1 = Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `month_master`
--

CREATE TABLE `month_master` (
  `id` int(11) NOT NULL,
  `month_name` varchar(200) NOT NULL,
  `month_code` int(11) NOT NULL,
  `active_month` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `class` int(11) NOT NULL,
  `sec` int(11) NOT NULL,
  `notice_category` varchar(255) NOT NULL,
  `notice` text NOT NULL,
  `img` varchar(255) NOT NULL,
  `is_allstu` int(11) NOT NULL COMMENT '1=all students,0=particular_student',
  `sent_status` varchar(2) NOT NULL DEFAULT 'S' COMMENT 'S=student,T=teachers',
  `sent_type` varchar(200) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notice_adm_wise`
--

CREATE TABLE `notice_adm_wise` (
  `id` int(11) NOT NULL,
  `notice_tbl_id` int(11) NOT NULL,
  `admno` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `online_transaction`
--

CREATE TABLE `online_transaction` (
  `id` int(11) NOT NULL,
  `order_id` varchar(15) NOT NULL,
  `tracking_id` varchar(200) DEFAULT NULL,
  `merchant_id` varchar(200) DEFAULT NULL,
  `pay_amount` varchar(200) DEFAULT NULL,
  `trans_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `payment_status` varchar(200) DEFAULT 'Y',
  `bank_ref_no` varchar(200) DEFAULT NULL,
  `order_status` varchar(200) DEFAULT NULL,
  `failure_msg` varchar(200) DEFAULT NULL,
  `pay_mode` varchar(200) DEFAULT NULL,
  `card_name` varchar(200) DEFAULT NULL,
  `status_code` varchar(200) DEFAULT NULL,
  `status_msg` varchar(200) DEFAULT NULL,
  `rcv_amt` varchar(200) DEFAULT NULL,
  `RECT_NO` varchar(15) NOT NULL,
  `RECT_DATE` date DEFAULT NULL,
  `STU_NAME` varchar(255) DEFAULT NULL,
  `STUDENTID` varchar(50) DEFAULT NULL,
  `ADM_NO` varchar(50) DEFAULT NULL,
  `CLASS` varchar(25) DEFAULT NULL,
  `SEC` varchar(10) DEFAULT NULL,
  `ROLL_NO` double DEFAULT NULL,
  `PERIOD` varchar(50) DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  `Fee1` double DEFAULT NULL,
  `Fee2` double DEFAULT NULL,
  `Fee3` double DEFAULT NULL,
  `Fee4` double DEFAULT NULL,
  `Fee5` double DEFAULT NULL,
  `Fee6` double DEFAULT NULL,
  `Fee7` double DEFAULT NULL,
  `Fee8` double DEFAULT NULL,
  `Fee9` double DEFAULT NULL,
  `Fee10` double DEFAULT NULL,
  `Fee11` double DEFAULT NULL,
  `Fee12` double DEFAULT NULL,
  `Fee13` double DEFAULT NULL,
  `Fee14` double DEFAULT NULL,
  `Fee15` double DEFAULT NULL,
  `Fee16` double DEFAULT NULL,
  `Fee17` double DEFAULT NULL,
  `Fee18` double DEFAULT NULL,
  `Fee19` double DEFAULT NULL,
  `Fee20` double DEFAULT NULL,
  `Fee21` double DEFAULT NULL,
  `Fee22` double DEFAULT NULL,
  `Fee23` double DEFAULT NULL,
  `Fee24` double DEFAULT NULL,
  `Fee25` double DEFAULT NULL,
  `APR_FEE` varchar(15) DEFAULT NULL,
  `MAY_FEE` varchar(15) DEFAULT NULL,
  `JUNE_FEE` varchar(8) DEFAULT NULL,
  `JULY_FEE` varchar(15) DEFAULT NULL,
  `AUG_FEE` varchar(15) DEFAULT NULL,
  `SEP_FEE` varchar(15) DEFAULT NULL,
  `OCT_FEE` varchar(15) DEFAULT NULL,
  `NOV_FEE` varchar(15) DEFAULT NULL,
  `DEC_FEE` varchar(15) DEFAULT NULL,
  `JAN_FEE` varchar(15) DEFAULT NULL,
  `FEB_FEE` varchar(15) DEFAULT NULL,
  `MAR_FEE` varchar(15) DEFAULT NULL,
  `CHQ_NO` varchar(15) DEFAULT NULL,
  `Narr` varchar(50) DEFAULT NULL,
  `TAmt` double DEFAULT NULL,
  `Fee_Book_No` varchar(255) DEFAULT NULL,
  `Collection_Mode` int(11) DEFAULT NULL,
  `User_Id` varchar(50) DEFAULT NULL,
  `Payment_Mode` mediumtext NOT NULL,
  `Bank_Name` varchar(500) NOT NULL DEFAULT 'N/A',
  `Pay_Date` date NOT NULL,
  `Session_Year` int(11) NOT NULL DEFAULT 2019,
  `FORM_NO` varchar(200) NOT NULL DEFAULT 'N/A',
  `voucher_created` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parents`
--

CREATE TABLE `parents` (
  `STDID` varchar(50) DEFAULT NULL,
  `ED_QUA` varchar(255) DEFAULT NULL,
  `OCCUPATION` varchar(255) DEFAULT NULL,
  `DESIG` varchar(255) DEFAULT NULL,
  `MTH_INCOME` varchar(255) DEFAULT NULL,
  `ADDRESS` varchar(255) DEFAULT NULL,
  `CITY` varchar(50) DEFAULT NULL,
  `STATE` varchar(50) DEFAULT NULL,
  `NATION` varchar(50) DEFAULT NULL,
  `PIN` varchar(50) DEFAULT NULL,
  `PHONE1` varchar(100) DEFAULT NULL,
  `PHONE2` varchar(100) DEFAULT NULL,
  `FAXNO` varchar(255) DEFAULT NULL,
  `MOBILE` varchar(255) DEFAULT NULL,
  `EMAIL` varchar(255) DEFAULT NULL,
  `PTYPE` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_mode`
--

CREATE TABLE `payment_mode` (
  `id` int(11) NOT NULL,
  `payment_mode` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payslip_dbo`
--

CREATE TABLE `payslip_dbo` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(255) DEFAULT NULL,
  `total_working_days` float(10,2) DEFAULT NULL,
  `total_present` float(10,2) DEFAULT NULL,
  `payslip_year` int(11) DEFAULT NULL,
  `payslip_month` int(11) DEFAULT NULL,
  `pay_date` timestamp NULL DEFAULT current_timestamp(),
  `actual_basic` double DEFAULT NULL,
  `basic_salary` double DEFAULT NULL,
  `da_percent` double DEFAULT 0,
  `da_pay` double DEFAULT 0,
  `hra_rate_percent` double DEFAULT 0,
  `hra_app` int(11) DEFAULT 0,
  `hra_pay` double DEFAULT 0,
  `ta_allowance_applied` int(11) DEFAULT 0,
  `ta_level` int(11) DEFAULT 0,
  `ta_pay` double DEFAULT 0,
  `fixed_allowance` double DEFAULT 0,
  `shift_allowance` double DEFAULT 0,
  `no_of_classes` float DEFAULT 0,
  `amt_per_class` float DEFAULT 0,
  `total_amount` float DEFAULT 0,
  `gross_salary` double DEFAULT 0,
  `pension_rate` float(10,2) NOT NULL,
  `pf_app` int(11) DEFAULT 0,
  `pf_own_rate` double DEFAULT 0,
  `pf_emp_rate` double DEFAULT 0,
  `pf_own_deduct` double DEFAULT 0,
  `fpf_deduct` double DEFAULT 0,
  `vpf_deduct` double DEFAULT 0,
  `esi_app` int(11) DEFAULT 0,
  `esi_own_rate` float DEFAULT 0,
  `esi_emp_rate` float DEFAULT 0,
  `esi_limit` double DEFAULT 0,
  `esi_deduct` double DEFAULT 0,
  `prof_tax` double DEFAULT 0,
  `lic` double DEFAULT 0,
  `hra_rent_deduct` double DEFAULT 0,
  `hra_security_deduct` double DEFAULT 0,
  `hra_garage_deduct` double DEFAULT 0,
  `hra_elect_deduct` double DEFAULT 0,
  `group_ins_app` int(11) DEFAULT 0,
  `group_insurance_amt` double DEFAULT 0,
  `staff_welfare_fund` double DEFAULT 0,
  `tds_deduct` double DEFAULT 0,
  `medical_deduct` double DEFAULT 0,
  `advance_salary_deduct` double DEFAULT 0,
  `total_deduction` double DEFAULT 0,
  `arrear_basic` double DEFAULT 0,
  `arrear_da` double DEFAULT 0,
  `arrear_hra` double DEFAULT 0,
  `arrear_ta` double DEFAULT 0,
  `arrear_fixed_allow` double DEFAULT 0,
  `arrear_shift_allow` double DEFAULT 0,
  `payable_amt` double DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `update_lock` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pay_control`
--

CREATE TABLE `pay_control` (
  `ID` int(11) NOT NULL,
  `EMPLOYEE_ID` int(11) DEFAULT NULL,
  `FPF` double DEFAULT 0,
  `VPF` double DEFAULT 0,
  `PROF_TAX` double DEFAULT 0,
  `LIC` double DEFAULT 0,
  `HRA_RENT` double DEFAULT 0,
  `HRA_ELECT` double DEFAULT 0,
  `HRA_SECURITY` double DEFAULT 0,
  `HRA_GARAGE` double DEFAULT 0,
  `TDS` double DEFAULT 0,
  `MEDICAL_DEDUCT` double DEFAULT 0,
  `FIXED_ALLOW` double DEFAULT 0,
  `SHIFT_ALLOW` double DEFAULT 0,
  `ARREAR_BASIC` double DEFAULT 0,
  `ARREAR_DA` double DEFAULT 0,
  `ARREAR_HRA` double DEFAULT 0,
  `ARREAR_TA` double DEFAULT 0,
  `ARREAR_FIXED_ALLOW` double DEFAULT 0,
  `ARREAR_SHIFT_ALLOW` double DEFAULT 0,
  `TOTAL_ADV_SAL_AMT` double DEFAULT 0,
  `TOTAL_DUE_AMT` double DEFAULT 0,
  `NO_OF_INSTALLMENT` int(11) DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permission_data`
--

CREATE TABLE `permission_data` (
  `ID` int(11) NOT NULL,
  `ROLE_ID` int(11) NOT NULL,
  `PERMISSION_DATA` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `previous_year_collection`
--

CREATE TABLE `previous_year_collection` (
  `RECT_NO` varchar(15) NOT NULL,
  `RECT_DATE` datetime DEFAULT NULL,
  `STU_NAME` varchar(255) DEFAULT NULL,
  `STUDENTID` varchar(50) DEFAULT NULL,
  `ADM_NO` varchar(255) DEFAULT NULL,
  `CLASS` varchar(25) DEFAULT NULL,
  `SEC` varchar(10) DEFAULT NULL,
  `ROLL_NO` double DEFAULT NULL,
  `PERIOD` varchar(50) DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  `Fee1` double DEFAULT NULL,
  `Fee2` double DEFAULT NULL,
  `Fee3` double DEFAULT NULL,
  `Fee4` double DEFAULT NULL,
  `Fee5` double DEFAULT NULL,
  `Fee6` double DEFAULT NULL,
  `Fee7` double DEFAULT NULL,
  `Fee8` double DEFAULT NULL,
  `Fee9` double DEFAULT NULL,
  `Fee10` double DEFAULT NULL,
  `Fee11` double DEFAULT NULL,
  `Fee12` double DEFAULT NULL,
  `Fee13` double DEFAULT NULL,
  `Fee14` double DEFAULT NULL,
  `Fee15` double DEFAULT NULL,
  `Fee16` double DEFAULT NULL,
  `Fee17` double DEFAULT NULL,
  `Fee18` double DEFAULT NULL,
  `Fee19` double DEFAULT NULL,
  `Fee20` double DEFAULT NULL,
  `Fee21` double DEFAULT NULL,
  `Fee22` double DEFAULT NULL,
  `Fee23` double DEFAULT NULL,
  `Fee24` double DEFAULT NULL,
  `Fee25` double DEFAULT NULL,
  `APR_FEE` varchar(15) DEFAULT NULL,
  `MAY_FEE` varchar(15) DEFAULT NULL,
  `JUNE_FEE` varchar(8) DEFAULT NULL,
  `JULY_FEE` varchar(15) DEFAULT NULL,
  `AUG_FEE` varchar(15) DEFAULT NULL,
  `SEP_FEE` varchar(15) DEFAULT NULL,
  `OCT_FEE` varchar(15) DEFAULT NULL,
  `NOV_FEE` varchar(15) DEFAULT NULL,
  `DEC_FEE` varchar(15) DEFAULT NULL,
  `JAN_FEE` varchar(15) DEFAULT NULL,
  `FEB_FEE` varchar(15) DEFAULT NULL,
  `MAR_FEE` varchar(15) DEFAULT NULL,
  `CHQ_NO` varchar(15) DEFAULT NULL,
  `Narr` varchar(50) DEFAULT NULL,
  `TAmt` double DEFAULT NULL,
  `Fee_Book_No` varchar(255) DEFAULT NULL,
  `Collection_Mode` int(11) DEFAULT NULL,
  `User_Id` varchar(50) DEFAULT NULL,
  `Payment_Mode` varchar(200) NOT NULL,
  `Bank_Name` varchar(200) NOT NULL,
  `Pay_Date` date NOT NULL,
  `Session_Year` varchar(200) NOT NULL,
  `FORM_NO` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `previous_year_feegeneration`
--

CREATE TABLE `previous_year_feegeneration` (
  `Month_NM` varchar(50) DEFAULT NULL,
  `STU_NAME` varchar(75) DEFAULT NULL,
  `STUDENTID` varchar(100) DEFAULT NULL,
  `ADM_NO` varchar(15) DEFAULT NULL,
  `CLASS` varchar(15) DEFAULT NULL,
  `SEC` varchar(10) DEFAULT NULL,
  `ROLL_NO` double DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  `Fee1` double DEFAULT NULL,
  `Fee2` double DEFAULT NULL,
  `Fee3` double DEFAULT NULL,
  `Fee4` double DEFAULT NULL,
  `Fee5` double DEFAULT NULL,
  `Fee6` double DEFAULT NULL,
  `Fee7` double DEFAULT NULL,
  `Fee8` double DEFAULT NULL,
  `Fee9` double DEFAULT NULL,
  `Fee10` double DEFAULT NULL,
  `Fee11` double DEFAULT NULL,
  `Fee12` double DEFAULT NULL,
  `Fee13` double DEFAULT NULL,
  `Fee14` double DEFAULT NULL,
  `Fee15` double DEFAULT NULL,
  `Fee16` double DEFAULT NULL,
  `Fee17` double DEFAULT NULL,
  `Fee18` double DEFAULT NULL,
  `Fee19` double DEFAULT NULL,
  `Fee20` double DEFAULT NULL,
  `Fee21` double DEFAULT NULL,
  `Fee22` double DEFAULT NULL,
  `Fee23` double DEFAULT NULL,
  `Fee24` double DEFAULT NULL,
  `Fee25` double DEFAULT NULL,
  `Fee_details` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `punching_raw_data`
--

CREATE TABLE `punching_raw_data` (
  `ID` int(11) NOT NULL,
  `CARDNO` varchar(32) NOT NULL,
  `OFFICEPUNCH` datetime NOT NULL,
  `REASONCODE` varchar(3) NOT NULL,
  `PROCESS` varchar(1) NOT NULL,
  `PUNCHFLAG` varchar(1) NOT NULL,
  `MACHINEID` int(11) NOT NULL,
  `EDATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `MACHINENO` varchar(50) NOT NULL,
  `PUNCHTYPE` varchar(50) NOT NULL,
  `LATITUDE` varchar(20) NOT NULL,
  `LONGITUDE` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `qualification`
--

CREATE TABLE `qualification` (
  `qualification` varchar(50) DEFAULT NULL,
  `Sno` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `record_keeping`
--

CREATE TABLE `record_keeping` (
  `ID` int(11) NOT NULL,
  `Adm_No` int(11) NOT NULL,
  `SName` varchar(255) NOT NULL,
  `FName` varchar(255) NOT NULL,
  `PhNo` varchar(20) NOT NULL,
  `Classes` varchar(100) NOT NULL,
  `Section` varchar(100) NOT NULL,
  `Record` text NOT NULL,
  `Date_of_Record` timestamp NOT NULL DEFAULT current_timestamp(),
  `Remarks_Class_Teacher` varchar(255) NOT NULL,
  `Remarks_Principal` text NOT NULL,
  `Feedback` text NOT NULL,
  `Date_Class_Teacher` varchar(100) NOT NULL,
  `Date_Principal` varchar(100) NOT NULL,
  `Date_Feedback` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reg`
--

CREATE TABLE `reg` (
  `id` int(11) NOT NULL,
  `un` varchar(100) NOT NULL,
  `pass` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `religion`
--

CREATE TABLE `religion` (
  `RNo` double NOT NULL,
  `Rname` varchar(20) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `remarks`
--

CREATE TABLE `remarks` (
  `ADM_NO` mediumtext DEFAULT NULL,
  `TERM` mediumtext DEFAULT NULL,
  `REMARKS` mediumtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role_master`
--

CREATE TABLE `role_master` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) DEFAULT NULL,
  `DESCRIPTION` varchar(255) DEFAULT NULL,
  `IS_SUPERADMIN` int(11) NOT NULL DEFAULT 0 COMMENT '1 = YES, 0 = NO',
  `IS_SYSTEM` int(11) NOT NULL DEFAULT 0,
  `IS_ACTIVE` int(11) NOT NULL DEFAULT 1 COMMENT '1 = YES, 0 = NO',
  `PRIORITY` int(11) NOT NULL DEFAULT 4 COMMENT '1 = HIGH, 2 = MIDDLE, 3 = LOW, 4 = LOWER'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `scholarship`
--

CREATE TABLE `scholarship` (
  `STU_NAME` varchar(255) DEFAULT NULL,
  `STUDENTID` varchar(255) DEFAULT NULL,
  `ADM_NO` varchar(255) NOT NULL,
  `CLASS` varchar(255) DEFAULT NULL,
  `SEC` varchar(255) DEFAULT NULL,
  `ROLL_NO` smallint(6) DEFAULT NULL,
  `AWARDED` smallint(6) DEFAULT NULL,
  `S1` double DEFAULT NULL,
  `S2` double DEFAULT NULL,
  `S3` double DEFAULT NULL,
  `S4` double DEFAULT NULL,
  `S5` double DEFAULT NULL,
  `S6` double DEFAULT NULL,
  `S7` double DEFAULT NULL,
  `S8` double DEFAULT NULL,
  `S9` double DEFAULT NULL,
  `S10` double DEFAULT NULL,
  `S11` double DEFAULT NULL,
  `S12` double DEFAULT NULL,
  `S13` double DEFAULT NULL,
  `S14` double DEFAULT NULL,
  `S15` double DEFAULT NULL,
  `S16` double DEFAULT NULL,
  `S17` double DEFAULT NULL,
  `S18` double DEFAULT NULL,
  `S19` double DEFAULT NULL,
  `S20` double DEFAULT NULL,
  `S21` double DEFAULT NULL,
  `S22` double DEFAULT NULL,
  `S23` double DEFAULT NULL,
  `S24` double DEFAULT NULL,
  `S25` double DEFAULT NULL,
  `Apply_From` varchar(255) DEFAULT NULL,
  `Owned_By` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `school_photo`
--

CREATE TABLE `school_photo` (
  `School_Logo` varchar(255) DEFAULT NULL,
  `School_Logo_RT` varchar(255) DEFAULT NULL,
  `PPLSIGN` mediumblob DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `school_setting`
--

CREATE TABLE `school_setting` (
  `S_No` varchar(10) NOT NULL,
  `School_Name` varchar(50) DEFAULT NULL,
  `School_Address` varchar(255) DEFAULT NULL,
  `School_PhoneNo` varchar(50) DEFAULT NULL,
  `School_MobileNo` varchar(50) DEFAULT NULL,
  `School_Code` varchar(50) DEFAULT NULL,
  `School_AfftNo` varchar(255) DEFAULT NULL,
  `School_Session` varchar(50) DEFAULT NULL,
  `School_Email` varchar(255) DEFAULT NULL,
  `School_Webaddress` varchar(255) DEFAULT NULL,
  `BkCode` varchar(50) DEFAULT NULL,
  `BkName` varchar(255) DEFAULT NULL,
  `BkBranch` varchar(50) DEFAULT NULL,
  `BkAddress` varchar(50) DEFAULT NULL,
  `LIC_Name` varchar(255) DEFAULT NULL,
  `LIC_Address` varchar(255) DEFAULT NULL,
  `Pen_Code` varchar(255) DEFAULT NULL,
  `Pen_Office` varchar(255) DEFAULT NULL,
  `short_nm` varchar(255) DEFAULT NULL,
  `SCHOOL_LOGO` varchar(500) NOT NULL,
  `auth_key` text NOT NULL,
  `sender_id` varchar(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `second_shift_attendance`
--

CREATE TABLE `second_shift_attendance` (
  `id` int(11) NOT NULL,
  `emp_id` varchar(255) NOT NULL,
  `year` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `no_of_classes` float NOT NULL,
  `amt_per_class` float NOT NULL,
  `total_amt` float NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_lock` int(11) NOT NULL DEFAULT 0 COMMENT '0 = No, 1 = Yes'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `section_no` int(11) NOT NULL,
  `SECTION_NAME` varchar(10) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `session_master`
--

CREATE TABLE `session_master` (
  `Session_ID` int(11) NOT NULL,
  `Session_Nm` mediumtext DEFAULT NULL,
  `Session_Year` int(11) DEFAULT NULL,
  `Active_Status` int(11) DEFAULT NULL,
  `database_name` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seventh_pay`
--

CREATE TABLE `seventh_pay` (
  `id` int(11) NOT NULL,
  `level_no` varchar(20) NOT NULL,
  `level_year` int(11) NOT NULL,
  `pay` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shift_master`
--

CREATE TABLE `shift_master` (
  `ID` int(11) NOT NULL,
  `SHIFT_NAME` varchar(255) DEFAULT NULL,
  `SHORT_NAME` varchar(20) DEFAULT NULL,
  `START_TIME` time DEFAULT NULL,
  `STOP_TIME` time DEFAULT NULL,
  `SHIFT_DURATION` time DEFAULT NULL,
  `RECESS_DURATION` time DEFAULT NULL,
  `MIN_HRS_HALF` time DEFAULT NULL,
  `MIN_HRS_FULL` time DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `short_recoverd_payment`
--

CREATE TABLE `short_recoverd_payment` (
  `id` int(50) NOT NULL,
  `RECT_NO` varchar(255) NOT NULL,
  `RECT_DATE` date DEFAULT NULL,
  `STU_NAME` varchar(255) DEFAULT NULL,
  `STUDENTID` varchar(50) DEFAULT NULL,
  `ADM_NO` varchar(50) DEFAULT NULL,
  `CLASS` varchar(25) DEFAULT NULL,
  `SEC` varchar(10) DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  `User_Id` varchar(50) DEFAULT NULL,
  `GROSS_AMOUNT` double DEFAULT NULL,
  `PAID_AMOUNT` double DEFAULT NULL,
  `SHORT_AMOUNT` double DEFAULT NULL,
  `Recovered_Short_Amt` double DEFAULT NULL,
  `applicable` int(11) NOT NULL DEFAULT 1,
  `updated_by` varchar(100) NOT NULL,
  `updated_on` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `signature`
--

CREATE TABLE `signature` (
  `SL_NO` mediumtext DEFAULT NULL,
  `SIGNATURE` mediumtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `state` varchar(500) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stoppage`
--

CREATE TABLE `stoppage` (
  `STOPPAGE` varchar(75) DEFAULT NULL,
  `STOPNO` double NOT NULL,
  `BUS_NO` varchar(25) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stop_amt`
--

CREATE TABLE `stop_amt` (
  `STOP_NO` double NOT NULL,
  `FROMDATE` timestamp NULL DEFAULT NULL,
  `AMT` double DEFAULT NULL,
  `APR_FEE` int(11) NOT NULL DEFAULT 0,
  `MAY_FEE` int(11) NOT NULL DEFAULT 0,
  `JUN_FEE` int(11) NOT NULL DEFAULT 0,
  `JUL_FEE` int(11) NOT NULL DEFAULT 0,
  `AUG_FEE` int(11) NOT NULL DEFAULT 0,
  `SEP_FEE` int(11) NOT NULL DEFAULT 0,
  `OCT_FEE` int(11) NOT NULL DEFAULT 0,
  `NOV_FEE` int(11) NOT NULL DEFAULT 0,
  `DEC_FEE` int(11) NOT NULL DEFAULT 0,
  `JAN_FEE` int(11) NOT NULL DEFAULT 0,
  `FEB_FEE` int(11) NOT NULL DEFAULT 0,
  `MAR_FEE` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `STUDENTID` varchar(50) DEFAULT NULL,
  `ADM_DATE` date DEFAULT NULL,
  `ADM_NO` varchar(50) NOT NULL,
  `BIRTH_DT` date DEFAULT NULL,
  `TITLE_NM` varchar(50) DEFAULT NULL,
  `FIRST_NM` varchar(50) DEFAULT NULL,
  `MIDDLE_NM` varchar(50) DEFAULT NULL,
  `BLOOD_GRP` varchar(25) DEFAULT NULL,
  `CATEGORY` smallint(6) DEFAULT NULL,
  `SEX` smallint(6) DEFAULT NULL,
  `NATION` varchar(25) DEFAULT NULL,
  `EMP_WARD` varchar(255) DEFAULT NULL,
  `EMPID` varchar(25) DEFAULT NULL,
  `FATHER_NM` varchar(50) DEFAULT NULL,
  `MOTHER_NM` varchar(50) DEFAULT NULL,
  `LAST_SCH` varchar(50) DEFAULT NULL,
  `LSCH_ADD` varchar(150) DEFAULT NULL,
  `ADM_CLASS` smallint(6) DEFAULT NULL,
  `ADM_SEC` smallint(6) DEFAULT NULL,
  `SIB_NO` smallint(6) DEFAULT NULL,
  `PERM_ADD` varchar(150) DEFAULT NULL,
  `P_CITY` varchar(50) DEFAULT NULL,
  `P_STATE` varchar(50) DEFAULT NULL,
  `P_NATION` varchar(50) DEFAULT NULL,
  `P_PIN` varchar(50) DEFAULT NULL,
  `P_PHONE1` varchar(50) DEFAULT NULL,
  `P_PHONE2` varchar(50) DEFAULT NULL,
  `P_FAXNO` varchar(50) DEFAULT NULL,
  `P_MOBILE` varchar(50) DEFAULT NULL,
  `P_EMAIL` varchar(50) DEFAULT NULL,
  `CORR_ADD` varchar(150) DEFAULT NULL,
  `C_CITY` varchar(50) DEFAULT NULL,
  `C_STATE` varchar(50) DEFAULT NULL,
  `C_NATION` varchar(50) DEFAULT NULL,
  `C_PIN` varchar(50) DEFAULT NULL,
  `C_PHONE1` varchar(50) DEFAULT NULL,
  `C_PHONE2` varchar(50) DEFAULT NULL,
  `C_FAXNO` varchar(50) DEFAULT NULL,
  `C_MOBILE` varchar(50) DEFAULT NULL,
  `C_EMAIL` varchar(50) DEFAULT NULL,
  `HOUSE_CODE` smallint(6) DEFAULT NULL,
  `CLASS` smallint(6) DEFAULT NULL,
  `DISP_CLASS` varchar(25) DEFAULT NULL,
  `SEC` smallint(6) DEFAULT NULL,
  `DISP_SEC` varchar(10) DEFAULT NULL,
  `ROLL_NO` smallint(6) DEFAULT NULL,
  `BUS_NO` varchar(35) DEFAULT NULL,
  `STOPNO` smallint(6) DEFAULT NULL,
  `FREESHIP` tinyint(1) DEFAULT NULL,
  `SCHOLAR` tinyint(1) DEFAULT NULL,
  `LETTERNO` varchar(50) DEFAULT NULL,
  `LIB_FLAG` varchar(50) DEFAULT NULL,
  `ACT_FLAG` varchar(50) DEFAULT NULL,
  `TC_ISSUED` tinyint(1) DEFAULT NULL,
  `COMPUTER` tinyint(1) DEFAULT NULL,
  `HOSTEL` tinyint(1) DEFAULT NULL,
  `TC_NUMBER` varchar(50) DEFAULT NULL,
  `PAID_UPTO` smallint(6) DEFAULT NULL,
  `SESSIONID` varchar(50) DEFAULT NULL,
  `APR_FEE` varchar(50) DEFAULT NULL,
  `MAY_FEE` varchar(50) DEFAULT NULL,
  `JUNE_FEE` varchar(50) DEFAULT NULL,
  `JULY_FEE` varchar(50) DEFAULT NULL,
  `AUG_FEE` varchar(50) DEFAULT NULL,
  `SEP_FEE` varchar(50) DEFAULT NULL,
  `OCT_FEE` varchar(50) DEFAULT NULL,
  `NOV_FEE` varchar(50) DEFAULT NULL,
  `DEC_FEE` varchar(50) DEFAULT NULL,
  `JAN_FEE` varchar(50) DEFAULT NULL,
  `FEB_FEE` varchar(50) DEFAULT NULL,
  `MAR_FEE` varchar(50) DEFAULT NULL,
  `CBSE_REG` varchar(50) DEFAULT NULL,
  `CBSE_ROLL` varchar(50) DEFAULT NULL,
  `SUBJECT1` varchar(50) DEFAULT NULL,
  `SUBJECT2` varchar(50) DEFAULT NULL,
  `SUBJECT3` varchar(50) DEFAULT NULL,
  `SUBJECT4` varchar(50) DEFAULT NULL,
  `SUBJECT5` varchar(50) DEFAULT NULL,
  `SUBJECT6` varchar(50) DEFAULT NULL,
  `WORK_DAYS` smallint(6) DEFAULT NULL,
  `APR_ATT` smallint(6) DEFAULT NULL,
  `MAY_ATT` smallint(6) DEFAULT NULL,
  `JUNE_ATT` smallint(6) DEFAULT NULL,
  `JULY_ATT` smallint(6) DEFAULT NULL,
  `AUG_ATT` smallint(6) DEFAULT NULL,
  `SEP_ATT` smallint(6) DEFAULT NULL,
  `OCT_ATT` smallint(6) DEFAULT NULL,
  `NOV_ATT` smallint(6) DEFAULT NULL,
  `DEC_ATT` smallint(6) DEFAULT NULL,
  `JAN_ATT` smallint(6) DEFAULT NULL,
  `FEB_ATT` smallint(6) DEFAULT NULL,
  `MAR_ATT` smallint(6) DEFAULT NULL,
  `UPD_DATE` datetime DEFAULT NULL,
  `oldadmno` varchar(50) DEFAULT NULL,
  `religion` smallint(6) DEFAULT NULL,
  `math_lab` tinyint(1) DEFAULT NULL,
  `busno1` smallint(6) DEFAULT NULL,
  `BFEE` varchar(50) DEFAULT NULL,
  `BFEEType` tinyint(1) DEFAULT NULL,
  `HFEE` varchar(50) DEFAULT NULL,
  `Mag` tinyint(1) DEFAULT NULL,
  `Fee_Book_No` int(11) DEFAULT 0,
  `Bus_Book_No` varchar(100) DEFAULT NULL,
  `Student_Status` varchar(50) DEFAULT NULL,
  `RemID` int(11) NOT NULL DEFAULT 0,
  `VL` varchar(50) NOT NULL DEFAULT 'N/A',
  `VR` varchar(50) NOT NULL DEFAULT 'N/A',
  `DEN` varchar(50) NOT NULL DEFAULT 'N/A',
  `Height` int(11) NOT NULL DEFAULT 0,
  `Weight` int(11) NOT NULL DEFAULT 0,
  `Password` varchar(255) NOT NULL DEFAULT 'bachpan@2019',
  `student_image` varchar(500) NOT NULL,
  `Parent_password` varchar(500) NOT NULL DEFAULT 'bachpan@2019',
  `route_id` int(11) NOT NULL DEFAULT 0,
  `student_transport_facility_id` int(11) NOT NULL DEFAULT 0,
  `mid_session_admisson_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '	0=ADMISSION IN APR,1=ADMISSION IN MID SESSION',
  `Admission_month` varchar(50) NOT NULL DEFAULT '1',
  `mid_session_payment_status` varchar(50) NOT NULL DEFAULT 'N/A',
  `Counter_payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `Login_Id` varchar(255) NOT NULL DEFAULT 'N/A'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `studentsubject`
--

CREATE TABLE `studentsubject` (
  `ID` int(11) NOT NULL,
  `Adm_no` mediumtext DEFAULT NULL,
  `Class` mediumtext DEFAULT NULL,
  `SEC` mediumtext DEFAULT NULL,
  `SUBCODE` mediumtext DEFAULT NULL,
  `OPTCODE` mediumtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_2324`
--

CREATE TABLE `student_2324` (
  `STUDENTID` varchar(50) DEFAULT NULL,
  `ADM_DATE` date DEFAULT NULL,
  `ADM_NO` varchar(50) NOT NULL,
  `BIRTH_DT` date DEFAULT NULL,
  `TITLE_NM` varchar(50) DEFAULT NULL,
  `FIRST_NM` varchar(50) DEFAULT NULL,
  `MIDDLE_NM` varchar(50) DEFAULT NULL,
  `BLOOD_GRP` varchar(25) DEFAULT NULL,
  `CATEGORY` smallint(6) DEFAULT NULL,
  `SEX` smallint(6) DEFAULT NULL,
  `NATION` varchar(25) DEFAULT NULL,
  `EMP_WARD` varchar(255) DEFAULT NULL,
  `EMPID` varchar(25) DEFAULT NULL,
  `FATHER_NM` varchar(50) DEFAULT NULL,
  `MOTHER_NM` varchar(50) DEFAULT NULL,
  `LAST_SCH` varchar(50) DEFAULT NULL,
  `LSCH_ADD` varchar(150) DEFAULT NULL,
  `ADM_CLASS` smallint(6) DEFAULT NULL,
  `ADM_SEC` smallint(6) DEFAULT NULL,
  `SIB_NO` smallint(6) DEFAULT NULL,
  `PERM_ADD` varchar(150) DEFAULT NULL,
  `P_CITY` varchar(50) DEFAULT NULL,
  `P_STATE` varchar(50) DEFAULT NULL,
  `P_NATION` varchar(50) DEFAULT NULL,
  `P_PIN` varchar(50) DEFAULT NULL,
  `P_PHONE1` varchar(50) DEFAULT NULL,
  `P_PHONE2` varchar(50) DEFAULT NULL,
  `P_FAXNO` varchar(50) DEFAULT NULL,
  `P_MOBILE` varchar(50) DEFAULT NULL,
  `P_EMAIL` varchar(50) DEFAULT NULL,
  `CORR_ADD` varchar(150) DEFAULT NULL,
  `C_CITY` varchar(50) DEFAULT NULL,
  `C_STATE` varchar(50) DEFAULT NULL,
  `C_NATION` varchar(50) DEFAULT NULL,
  `C_PIN` varchar(50) DEFAULT NULL,
  `C_PHONE1` varchar(50) DEFAULT NULL,
  `C_PHONE2` varchar(50) DEFAULT NULL,
  `C_FAXNO` varchar(50) DEFAULT NULL,
  `C_MOBILE` varchar(50) DEFAULT NULL,
  `C_EMAIL` varchar(50) DEFAULT NULL,
  `HOUSE_CODE` smallint(6) DEFAULT NULL,
  `CLASS` smallint(6) DEFAULT NULL,
  `DISP_CLASS` varchar(25) DEFAULT NULL,
  `SEC` smallint(6) DEFAULT NULL,
  `DISP_SEC` varchar(10) DEFAULT NULL,
  `ROLL_NO` smallint(6) DEFAULT NULL,
  `BUS_NO` varchar(35) DEFAULT NULL,
  `STOPNO` smallint(6) DEFAULT NULL,
  `FREESHIP` tinyint(1) DEFAULT NULL,
  `SCHOLAR` tinyint(1) DEFAULT NULL,
  `LETTERNO` varchar(50) DEFAULT NULL,
  `LIB_FLAG` varchar(50) DEFAULT NULL,
  `ACT_FLAG` varchar(50) DEFAULT NULL,
  `TC_ISSUED` tinyint(1) DEFAULT NULL,
  `COMPUTER` tinyint(1) DEFAULT NULL,
  `HOSTEL` tinyint(1) DEFAULT NULL,
  `TC_NUMBER` varchar(50) DEFAULT NULL,
  `PAID_UPTO` smallint(6) DEFAULT NULL,
  `SESSIONID` varchar(50) DEFAULT NULL,
  `APR_FEE` varchar(50) DEFAULT NULL,
  `MAY_FEE` varchar(50) DEFAULT NULL,
  `JUNE_FEE` varchar(50) DEFAULT NULL,
  `JULY_FEE` varchar(50) DEFAULT NULL,
  `AUG_FEE` varchar(50) DEFAULT NULL,
  `SEP_FEE` varchar(50) DEFAULT NULL,
  `OCT_FEE` varchar(50) DEFAULT NULL,
  `NOV_FEE` varchar(50) DEFAULT NULL,
  `DEC_FEE` varchar(50) DEFAULT NULL,
  `JAN_FEE` varchar(50) DEFAULT NULL,
  `FEB_FEE` varchar(50) DEFAULT NULL,
  `MAR_FEE` varchar(50) DEFAULT NULL,
  `CBSE_REG` varchar(50) DEFAULT NULL,
  `CBSE_ROLL` varchar(50) DEFAULT NULL,
  `SUBJECT1` varchar(50) DEFAULT NULL,
  `SUBJECT2` varchar(50) DEFAULT NULL,
  `SUBJECT3` varchar(50) DEFAULT NULL,
  `SUBJECT4` varchar(50) DEFAULT NULL,
  `SUBJECT5` varchar(50) DEFAULT NULL,
  `SUBJECT6` varchar(50) DEFAULT NULL,
  `WORK_DAYS` smallint(6) DEFAULT NULL,
  `APR_ATT` smallint(6) DEFAULT NULL,
  `MAY_ATT` smallint(6) DEFAULT NULL,
  `JUNE_ATT` smallint(6) DEFAULT NULL,
  `JULY_ATT` smallint(6) DEFAULT NULL,
  `AUG_ATT` smallint(6) DEFAULT NULL,
  `SEP_ATT` smallint(6) DEFAULT NULL,
  `OCT_ATT` smallint(6) DEFAULT NULL,
  `NOV_ATT` smallint(6) DEFAULT NULL,
  `DEC_ATT` smallint(6) DEFAULT NULL,
  `JAN_ATT` smallint(6) DEFAULT NULL,
  `FEB_ATT` smallint(6) DEFAULT NULL,
  `MAR_ATT` smallint(6) DEFAULT NULL,
  `UPD_DATE` datetime DEFAULT NULL,
  `oldadmno` varchar(50) DEFAULT NULL,
  `religion` smallint(6) DEFAULT NULL,
  `math_lab` tinyint(1) DEFAULT NULL,
  `busno1` smallint(6) DEFAULT NULL,
  `BFEE` varchar(50) DEFAULT NULL,
  `BFEEType` tinyint(1) DEFAULT NULL,
  `HFEE` varchar(50) DEFAULT NULL,
  `Mag` tinyint(1) DEFAULT NULL,
  `Fee_Book_No` int(11) DEFAULT 0,
  `Bus_Book_No` varchar(100) DEFAULT NULL,
  `Student_Status` varchar(50) DEFAULT NULL,
  `RemID` int(11) NOT NULL DEFAULT 0,
  `VL` varchar(50) NOT NULL DEFAULT 'N/A',
  `VR` varchar(50) NOT NULL DEFAULT 'N/A',
  `DEN` varchar(50) NOT NULL DEFAULT 'N/A',
  `Height` int(11) NOT NULL DEFAULT 0,
  `Weight` int(11) NOT NULL DEFAULT 0,
  `Password` varchar(255) NOT NULL DEFAULT 'bachpan@2019',
  `student_image` varchar(500) NOT NULL,
  `Parent_password` varchar(500) NOT NULL DEFAULT 'bachpan@2019',
  `route_id` int(11) NOT NULL DEFAULT 0,
  `student_transport_facility_id` int(11) NOT NULL DEFAULT 0,
  `mid_session_admisson_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '	0=ADMISSION IN APR,1=ADMISSION IN MID SESSION',
  `Admission_month` varchar(50) NOT NULL DEFAULT '1',
  `mid_session_payment_status` varchar(50) NOT NULL DEFAULT 'N/A',
  `Counter_payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `Login_Id` varchar(255) NOT NULL DEFAULT 'N/A'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_20012024`
--

CREATE TABLE `student_20012024` (
  `STUDENTID` varchar(50) DEFAULT NULL,
  `ADM_DATE` date DEFAULT NULL,
  `ADM_NO` varchar(50) NOT NULL,
  `BIRTH_DT` date DEFAULT NULL,
  `TITLE_NM` varchar(50) DEFAULT NULL,
  `FIRST_NM` varchar(50) DEFAULT NULL,
  `MIDDLE_NM` varchar(50) DEFAULT NULL,
  `BLOOD_GRP` varchar(25) DEFAULT NULL,
  `CATEGORY` smallint(6) DEFAULT NULL,
  `SEX` smallint(6) DEFAULT NULL,
  `NATION` varchar(25) DEFAULT NULL,
  `EMP_WARD` varchar(255) DEFAULT NULL,
  `EMPID` varchar(25) DEFAULT NULL,
  `FATHER_NM` varchar(50) DEFAULT NULL,
  `MOTHER_NM` varchar(50) DEFAULT NULL,
  `LAST_SCH` varchar(50) DEFAULT NULL,
  `LSCH_ADD` varchar(150) DEFAULT NULL,
  `ADM_CLASS` smallint(6) DEFAULT NULL,
  `ADM_SEC` smallint(6) DEFAULT NULL,
  `SIB_NO` smallint(6) DEFAULT NULL,
  `PERM_ADD` varchar(150) DEFAULT NULL,
  `P_CITY` varchar(50) DEFAULT NULL,
  `P_STATE` varchar(50) DEFAULT NULL,
  `P_NATION` varchar(50) DEFAULT NULL,
  `P_PIN` varchar(50) DEFAULT NULL,
  `P_PHONE1` varchar(50) DEFAULT NULL,
  `P_PHONE2` varchar(50) DEFAULT NULL,
  `P_FAXNO` varchar(50) DEFAULT NULL,
  `P_MOBILE` varchar(50) DEFAULT NULL,
  `P_EMAIL` varchar(50) DEFAULT NULL,
  `CORR_ADD` varchar(150) DEFAULT NULL,
  `C_CITY` varchar(50) DEFAULT NULL,
  `C_STATE` varchar(50) DEFAULT NULL,
  `C_NATION` varchar(50) DEFAULT NULL,
  `C_PIN` varchar(50) DEFAULT NULL,
  `C_PHONE1` varchar(50) DEFAULT NULL,
  `C_PHONE2` varchar(50) DEFAULT NULL,
  `C_FAXNO` varchar(50) DEFAULT NULL,
  `C_MOBILE` varchar(50) DEFAULT NULL,
  `C_EMAIL` varchar(50) DEFAULT NULL,
  `HOUSE_CODE` smallint(6) DEFAULT NULL,
  `CLASS` smallint(6) DEFAULT NULL,
  `DISP_CLASS` varchar(25) DEFAULT NULL,
  `SEC` smallint(6) DEFAULT NULL,
  `DISP_SEC` varchar(10) DEFAULT NULL,
  `ROLL_NO` smallint(6) DEFAULT NULL,
  `BUS_NO` varchar(35) DEFAULT NULL,
  `STOPNO` smallint(6) DEFAULT NULL,
  `FREESHIP` tinyint(1) DEFAULT NULL,
  `SCHOLAR` tinyint(1) DEFAULT NULL,
  `LETTERNO` varchar(50) DEFAULT NULL,
  `LIB_FLAG` varchar(50) DEFAULT NULL,
  `ACT_FLAG` varchar(50) DEFAULT NULL,
  `TC_ISSUED` tinyint(1) DEFAULT NULL,
  `COMPUTER` tinyint(1) DEFAULT NULL,
  `HOSTEL` tinyint(1) DEFAULT NULL,
  `TC_NUMBER` varchar(50) DEFAULT NULL,
  `PAID_UPTO` smallint(6) DEFAULT NULL,
  `SESSIONID` varchar(50) DEFAULT NULL,
  `APR_FEE` varchar(50) DEFAULT NULL,
  `MAY_FEE` varchar(50) DEFAULT NULL,
  `JUNE_FEE` varchar(50) DEFAULT NULL,
  `JULY_FEE` varchar(50) DEFAULT NULL,
  `AUG_FEE` varchar(50) DEFAULT NULL,
  `SEP_FEE` varchar(50) DEFAULT NULL,
  `OCT_FEE` varchar(50) DEFAULT NULL,
  `NOV_FEE` varchar(50) DEFAULT NULL,
  `DEC_FEE` varchar(50) DEFAULT NULL,
  `JAN_FEE` varchar(50) DEFAULT NULL,
  `FEB_FEE` varchar(50) DEFAULT NULL,
  `MAR_FEE` varchar(50) DEFAULT NULL,
  `CBSE_REG` varchar(50) DEFAULT NULL,
  `CBSE_ROLL` varchar(50) DEFAULT NULL,
  `SUBJECT1` varchar(50) DEFAULT NULL,
  `SUBJECT2` varchar(50) DEFAULT NULL,
  `SUBJECT3` varchar(50) DEFAULT NULL,
  `SUBJECT4` varchar(50) DEFAULT NULL,
  `SUBJECT5` varchar(50) DEFAULT NULL,
  `SUBJECT6` varchar(50) DEFAULT NULL,
  `WORK_DAYS` smallint(6) DEFAULT NULL,
  `APR_ATT` smallint(6) DEFAULT NULL,
  `MAY_ATT` smallint(6) DEFAULT NULL,
  `JUNE_ATT` smallint(6) DEFAULT NULL,
  `JULY_ATT` smallint(6) DEFAULT NULL,
  `AUG_ATT` smallint(6) DEFAULT NULL,
  `SEP_ATT` smallint(6) DEFAULT NULL,
  `OCT_ATT` smallint(6) DEFAULT NULL,
  `NOV_ATT` smallint(6) DEFAULT NULL,
  `DEC_ATT` smallint(6) DEFAULT NULL,
  `JAN_ATT` smallint(6) DEFAULT NULL,
  `FEB_ATT` smallint(6) DEFAULT NULL,
  `MAR_ATT` smallint(6) DEFAULT NULL,
  `UPD_DATE` datetime DEFAULT NULL,
  `oldadmno` varchar(50) DEFAULT NULL,
  `religion` smallint(6) DEFAULT NULL,
  `math_lab` tinyint(1) DEFAULT NULL,
  `busno1` smallint(6) DEFAULT NULL,
  `BFEE` varchar(50) DEFAULT NULL,
  `BFEEType` tinyint(1) DEFAULT NULL,
  `HFEE` varchar(50) DEFAULT NULL,
  `Mag` tinyint(1) DEFAULT NULL,
  `Fee_Book_No` int(11) DEFAULT 0,
  `Bus_Book_No` varchar(100) DEFAULT NULL,
  `Student_Status` varchar(50) DEFAULT NULL,
  `RemID` int(11) NOT NULL DEFAULT 0,
  `VL` varchar(50) NOT NULL DEFAULT 'N/A',
  `VR` varchar(50) NOT NULL DEFAULT 'N/A',
  `DEN` varchar(50) NOT NULL DEFAULT 'N/A',
  `Height` int(11) NOT NULL DEFAULT 0,
  `Weight` int(11) NOT NULL DEFAULT 0,
  `Password` varchar(255) NOT NULL DEFAULT 'bachpan@2019',
  `student_image` varchar(500) NOT NULL,
  `Parent_password` varchar(500) NOT NULL DEFAULT 'bachpan@2019',
  `route_id` int(11) NOT NULL DEFAULT 0,
  `student_transport_facility_id` int(11) NOT NULL DEFAULT 0,
  `mid_session_admisson_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '	0=ADMISSION IN APR,1=ADMISSION IN MID SESSION',
  `Admission_month` varchar(50) NOT NULL DEFAULT '1',
  `mid_session_payment_status` varchar(50) NOT NULL DEFAULT 'N/A',
  `Counter_payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `Login_Id` varchar(255) NOT NULL DEFAULT 'N/A'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_attendance_type`
--

CREATE TABLE `student_attendance_type` (
  `id` int(11) NOT NULL,
  `class_code` int(11) NOT NULL,
  `class_nm` varchar(200) NOT NULL,
  `attendance_type` int(11) NOT NULL DEFAULT 1 COMMENT '1=day_wise,2=period_wise'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_bus_facility_details`
--

CREATE TABLE `student_bus_facility_details` (
  `S_ID` int(11) DEFAULT NULL,
  `ADM_NO` mediumtext DEFAULT NULL,
  `STOPNO` int(11) DEFAULT NULL,
  `Old_STOPNO` int(11) DEFAULT NULL,
  `Applicable_Month` mediumtext DEFAULT NULL,
  `Change_Date` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_ledger_opening_bal`
--

CREATE TABLE `student_ledger_opening_bal` (
  `admno` varchar(25) DEFAULT NULL,
  `monthnm` varchar(150) DEFAULT NULL,
  `total_amount` double DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_remarks`
--

CREATE TABLE `student_remarks` (
  `Remarks_Id` int(11) DEFAULT NULL,
  `Remarks` mediumtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_transport_facility`
--

CREATE TABLE `student_transport_facility` (
  `ID` int(11) NOT NULL,
  `ADM_NO` varchar(50) NOT NULL,
  `OLD_STOPNO` int(11) NOT NULL,
  `NEW_STOPNO` int(11) NOT NULL,
  `FROM_APPLICABLE_MONTH` varchar(50) NOT NULL,
  `TO_APPLICABLE_MONTH` varchar(50) NOT NULL,
  `FROM_APPLICABLE_MONTH_CODE` int(11) NOT NULL,
  `TO_APPLICABLE_MONTH_CODE` int(11) NOT NULL,
  `CREATED_DATE` timestamp NOT NULL DEFAULT current_timestamp(),
  `USER_ID` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_transport_facility_dec`
--

CREATE TABLE `student_transport_facility_dec` (
  `ID` int(11) DEFAULT NULL,
  `ADM_NO` varchar(50) DEFAULT NULL,
  `OLD_STOPNO` int(11) DEFAULT NULL,
  `NEW_STOPNO` int(11) DEFAULT NULL,
  `FROM_APPLICABLE_MONTH` varchar(50) DEFAULT NULL,
  `TO_APPLICABLE_MONTH` varchar(50) DEFAULT NULL,
  `FROM_APPLICABLE_MONTH_CODE` int(11) DEFAULT NULL,
  `TO_APPLICABLE_MONTH_CODE` int(11) DEFAULT NULL,
  `CREATED_DATE` datetime DEFAULT NULL,
  `USER_ID` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `stu_attendance_entry`
--

CREATE TABLE `stu_attendance_entry` (
  `id` int(11) NOT NULL,
  `class_code` int(11) NOT NULL,
  `sec_code` int(11) NOT NULL,
  `admno` varchar(255) NOT NULL,
  `att_status` varchar(255) NOT NULL COMMENT 'P=present,A=absent,HD=half_day',
  `remarks` text NOT NULL,
  `att_date` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stu_attendance_entry_periodwise`
--

CREATE TABLE `stu_attendance_entry_periodwise` (
  `id` int(11) NOT NULL,
  `class_code` int(11) NOT NULL,
  `sec_code` int(11) NOT NULL,
  `admno` varchar(255) NOT NULL,
  `att_status` varchar(255) NOT NULL COMMENT 'P=present,A=absent',
  `period` int(11) NOT NULL,
  `att_date` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `SubCode` int(11) DEFAULT NULL,
  `SubName` varchar(50) DEFAULT NULL,
  `SubSName` varchar(10) DEFAULT NULL,
  `Bundle_Count` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `t1`
--

CREATE TABLE `t1` (
  `RECT_NO` varchar(50) DEFAULT NULL,
  `RECT_DATE` datetime DEFAULT NULL,
  `STU_NAME` varchar(255) DEFAULT NULL,
  `STUDENTID` varchar(50) DEFAULT NULL,
  `ADM_NO` varchar(50) DEFAULT NULL,
  `CLASS` varchar(50) DEFAULT NULL,
  `SEC` varchar(50) DEFAULT NULL,
  `ROLL_NO` double DEFAULT NULL,
  `PERIOD` varchar(255) DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  `Fee1` double DEFAULT NULL,
  `Fee2` double DEFAULT NULL,
  `Fee3` double DEFAULT NULL,
  `Fee4` double DEFAULT NULL,
  `Fee5` double DEFAULT NULL,
  `Fee6` double DEFAULT NULL,
  `Fee7` double DEFAULT NULL,
  `Fee8` double DEFAULT NULL,
  `Fee9` double DEFAULT NULL,
  `Fee10` double DEFAULT NULL,
  `Fee11` double DEFAULT NULL,
  `Fee12` double DEFAULT NULL,
  `Fee13` double DEFAULT NULL,
  `Fee14` double DEFAULT NULL,
  `Fee15` double DEFAULT NULL,
  `Fee16` double DEFAULT NULL,
  `Fee17` double DEFAULT NULL,
  `Fee18` double DEFAULT NULL,
  `Fee19` double DEFAULT NULL,
  `Fee20` double DEFAULT NULL,
  `Fee21` double DEFAULT NULL,
  `Fee22` double DEFAULT NULL,
  `Fee23` double DEFAULT NULL,
  `Fee24` double DEFAULT NULL,
  `Fee25` double DEFAULT NULL,
  `APR_FEE` varchar(50) DEFAULT NULL,
  `MAY_FEE` varchar(50) DEFAULT NULL,
  `JUNE_FEE` varchar(50) DEFAULT NULL,
  `JULY_FEE` varchar(50) DEFAULT NULL,
  `AUG_FEE` varchar(50) DEFAULT NULL,
  `SEP_FEE` varchar(50) DEFAULT NULL,
  `OCT_FEE` varchar(50) DEFAULT NULL,
  `NOV_FEE` varchar(50) DEFAULT NULL,
  `DEC_FEE` varchar(50) DEFAULT NULL,
  `JAN_FEE` varchar(50) DEFAULT NULL,
  `FEB_FEE` varchar(50) DEFAULT NULL,
  `MAR_FEE` varchar(50) DEFAULT NULL,
  `CHQ_NO` varchar(255) DEFAULT NULL,
  `Narr` varchar(50) DEFAULT NULL,
  `TAmt` double DEFAULT NULL,
  `Fee_Book_No` varchar(255) DEFAULT NULL,
  `Collection_Mode` int(11) DEFAULT NULL,
  `User_Id` varchar(50) DEFAULT NULL,
  `Payment_Mode` varchar(255) DEFAULT NULL,
  `Bank_Name` varchar(255) DEFAULT NULL,
  `Pay_Date` datetime DEFAULT NULL,
  `Session_Year` int(11) DEFAULT NULL,
  `FORM_NO` varchar(255) DEFAULT NULL,
  `voucher_created` int(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tc`
--

CREATE TABLE `tc` (
  `TCNO` mediumtext DEFAULT NULL,
  `adm_no` mediumtext DEFAULT NULL,
  `RegistrationNo` mediumtext DEFAULT NULL,
  `BoardRollNo` mediumtext DEFAULT NULL,
  `Name` mediumtext DEFAULT NULL,
  `Mother_NM` mediumtext DEFAULT NULL,
  `Father_NM` mediumtext DEFAULT NULL,
  `Nation` mediumtext DEFAULT NULL,
  `Category` mediumtext DEFAULT NULL,
  `ADM_DATE` date DEFAULT NULL,
  `ADM_CLASS` mediumtext DEFAULT NULL,
  `BIRTH_DT` date DEFAULT NULL,
  `current_Class` mediumtext DEFAULT NULL,
  `TEXT08a` mediumtext DEFAULT NULL,
  `text08b` mediumtext DEFAULT NULL,
  `combo09` mediumtext DEFAULT NULL,
  `textsub1` mediumtext DEFAULT NULL,
  `textsub2` mediumtext DEFAULT NULL,
  `textsub3` mediumtext DEFAULT NULL,
  `textsub4` mediumtext DEFAULT NULL,
  `textsub5` mediumtext DEFAULT NULL,
  `textsub6` mediumtext DEFAULT NULL,
  `textsub7` mediumtext DEFAULT NULL,
  `combo011` mediumtext DEFAULT NULL,
  `datacombo011` mediumtext DEFAULT NULL,
  `txtClsW` mediumtext DEFAULT NULL,
  `combo12a` mediumtext DEFAULT NULL,
  `combo012b` mediumtext DEFAULT NULL,
  `combo013` mediumtext DEFAULT NULL,
  `text014` mediumtext DEFAULT NULL,
  `text015` mediumtext DEFAULT NULL,
  `combo016` mediumtext DEFAULT NULL,
  `text017` mediumtext DEFAULT NULL,
  `combo018` mediumtext DEFAULT NULL,
  `text019` date DEFAULT NULL,
  `text020` date DEFAULT NULL,
  `text021` mediumtext DEFAULT NULL,
  `text022` mediumtext DEFAULT NULL,
  `dob_inwords` mediumtext DEFAULT NULL,
  `Tc_Status` mediumtext DEFAULT NULL,
  `duplicate_issue` smallint(6) DEFAULT NULL,
  `session_year` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tcash`
--

CREATE TABLE `tcash` (
  `VNo` varchar(50) DEFAULT NULL,
  `TDate` datetime DEFAULT NULL,
  `CCode` int(11) DEFAULT NULL,
  `PR` varchar(50) DEFAULT NULL,
  `Amt` double DEFAULT NULL,
  `Nar` mediumtext DEFAULT NULL,
  `SNo` int(11) NOT NULL,
  `SG` int(11) DEFAULT NULL,
  `ANSWER` int(11) DEFAULT 1,
  `AG` varchar(50) DEFAULT NULL,
  `ENo` double DEFAULT NULL,
  `AcT` int(11) DEFAULT 0,
  `MLCODE` varchar(20) DEFAULT NULL,
  `ECode` tinyint(4) DEFAULT NULL,
  `VType` tinyint(4) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tc_remarks`
--

CREATE TABLE `tc_remarks` (
  `REMARKS` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_daycoll`
--

CREATE TABLE `temp_daycoll` (
  `RECT_NO` varchar(255) NOT NULL,
  `RECT_DATE` date DEFAULT NULL,
  `STU_NAME` varchar(255) DEFAULT NULL,
  `STUDENTID` varchar(255) DEFAULT NULL,
  `ADM_NO` varchar(250) DEFAULT NULL,
  `CLASS` varchar(25) DEFAULT NULL,
  `SEC` varchar(10) DEFAULT NULL,
  `ROLL_NO` double DEFAULT NULL,
  `PERIOD` varchar(255) DEFAULT NULL,
  `TOTAL` double DEFAULT NULL,
  `Fee1` double DEFAULT NULL,
  `Fee2` double DEFAULT NULL,
  `Fee3` double DEFAULT NULL,
  `Fee4` double DEFAULT NULL,
  `Fee5` double DEFAULT NULL,
  `Fee6` double DEFAULT NULL,
  `Fee7` double DEFAULT NULL,
  `Fee8` double DEFAULT NULL,
  `Fee9` double DEFAULT NULL,
  `Fee10` double DEFAULT NULL,
  `Fee11` double DEFAULT NULL,
  `Fee12` double DEFAULT NULL,
  `Fee13` double DEFAULT NULL,
  `Fee14` double DEFAULT NULL,
  `Fee15` double DEFAULT NULL,
  `Fee16` double DEFAULT NULL,
  `Fee17` double DEFAULT NULL,
  `Fee18` double DEFAULT NULL,
  `Fee19` double DEFAULT NULL,
  `Fee20` double DEFAULT NULL,
  `Fee21` double DEFAULT NULL,
  `Fee22` double DEFAULT NULL,
  `Fee23` double DEFAULT NULL,
  `Fee24` double DEFAULT NULL,
  `Fee25` double DEFAULT NULL,
  `APR_FEE` varchar(255) DEFAULT NULL,
  `MAY_FEE` varchar(255) DEFAULT NULL,
  `JUNE_FEE` varchar(255) DEFAULT NULL,
  `JULY_FEE` varchar(255) DEFAULT NULL,
  `AUG_FEE` varchar(255) DEFAULT NULL,
  `SEP_FEE` varchar(255) DEFAULT NULL,
  `OCT_FEE` varchar(255) DEFAULT NULL,
  `NOV_FEE` varchar(255) DEFAULT NULL,
  `DEC_FEE` varchar(255) DEFAULT NULL,
  `JAN_FEE` varchar(255) DEFAULT NULL,
  `FEB_FEE` varchar(255) DEFAULT NULL,
  `MAR_FEE` varchar(255) DEFAULT NULL,
  `CHQ_NO` varchar(255) DEFAULT NULL,
  `Narr` varchar(255) DEFAULT NULL,
  `TAmt` double DEFAULT NULL,
  `Fee_Book_No` varchar(255) DEFAULT NULL,
  `Collection_Mode` int(11) DEFAULT NULL,
  `User_Id` varchar(255) DEFAULT NULL,
  `Payment_Mode` mediumtext NOT NULL,
  `Bank_Name` varchar(500) NOT NULL DEFAULT 'N/A',
  `Pay_Date` date NOT NULL,
  `Session_Year` int(11) NOT NULL DEFAULT 2019,
  `FORM_NO` varchar(200) NOT NULL DEFAULT 'N/A',
  `voucher_created` int(11) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_report_card`
--

CREATE TABLE `temp_report_card` (
  `id` int(11) NOT NULL,
  `adm_no` int(11) NOT NULL,
  `classes` varchar(100) NOT NULL,
  `sec` varchar(100) NOT NULL,
  `term` varchar(100) NOT NULL,
  `first_nm` varchar(255) NOT NULL,
  `roll_no` int(11) NOT NULL,
  `tot_wet_mrk` int(11) NOT NULL,
  `tot_per` int(11) NOT NULL,
  `tot_grd` varchar(100) NOT NULL,
  `attendance` varchar(100) NOT NULL,
  `subj1_nm` varchar(255) NOT NULL,
  `subj1_mo` varchar(11) NOT NULL,
  `subj1_per` int(11) NOT NULL,
  `subj1_grd` varchar(100) NOT NULL,
  `subj2_nm` varchar(255) NOT NULL,
  `subj2_mo` varchar(11) NOT NULL,
  `subj2_per` int(11) NOT NULL,
  `subj2_grd` varchar(100) NOT NULL,
  `subj3_nm` varchar(255) NOT NULL,
  `subj3_mo` varchar(11) NOT NULL,
  `subj3_per` int(11) NOT NULL,
  `subj3_grd` varchar(100) NOT NULL,
  `subj4_nm` varchar(255) NOT NULL,
  `subj4_mo` varchar(11) NOT NULL,
  `subj4_per` int(11) NOT NULL,
  `subj4_grd` varchar(100) NOT NULL,
  `subj5_nm` varchar(255) NOT NULL,
  `subj5_mo` varchar(11) NOT NULL,
  `subj5_per` int(11) NOT NULL,
  `subj5_grd` varchar(100) NOT NULL,
  `subj6_nm` varchar(255) NOT NULL,
  `subj6_mo` varchar(11) NOT NULL,
  `subj6_per` int(11) NOT NULL,
  `subj6_grd` varchar(100) NOT NULL,
  `subj7_nm` varchar(255) NOT NULL,
  `subj7_mo` varchar(11) NOT NULL,
  `subj7_per` int(11) NOT NULL,
  `subj7_grd` varchar(100) NOT NULL,
  `subj8_nm` varchar(255) NOT NULL,
  `subj8_mo` varchar(11) NOT NULL,
  `subj8_per` int(11) NOT NULL,
  `subj8_grd` varchar(100) NOT NULL,
  `subj9_nm` varchar(255) NOT NULL,
  `subj9_mo` varchar(11) NOT NULL,
  `subj9_per` int(11) NOT NULL,
  `subj9_grd` varchar(100) NOT NULL,
  `subj10_nm` varchar(255) NOT NULL,
  `subj10_mo` varchar(11) NOT NULL,
  `subj10_per` int(11) NOT NULL,
  `subj10_grd` varchar(100) NOT NULL,
  `subj11_nm` varchar(255) NOT NULL,
  `subj11_mo` varchar(11) NOT NULL,
  `subj11_per` int(11) NOT NULL,
  `subj11_grd` varchar(100) NOT NULL,
  `subj12_nm` varchar(255) NOT NULL,
  `subj12_mo` varchar(11) NOT NULL,
  `subj12_per` int(11) NOT NULL,
  `subj12_grd` varchar(100) NOT NULL,
  `subj13_nm` varchar(255) NOT NULL,
  `subj13_mo` varchar(11) NOT NULL,
  `subj13_per` int(11) NOT NULL,
  `subj13_grd` varchar(100) NOT NULL,
  `subj14_nm` varchar(255) NOT NULL,
  `subj14_mo` varchar(11) NOT NULL,
  `subj14_per` int(11) NOT NULL,
  `subj14_grd` varchar(100) NOT NULL,
  `subj15_nm` varchar(255) NOT NULL,
  `subj15_mo` varchar(11) NOT NULL,
  `subj15_per` int(11) NOT NULL,
  `subj15_grd` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temp_voucher_db`
--

CREATE TABLE `temp_voucher_db` (
  `id` int(11) NOT NULL,
  `voucher_no` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `ac_type` varchar(255) NOT NULL,
  `dc` varchar(1) NOT NULL,
  `ac_head` text NOT NULL,
  `amount` float(10,2) NOT NULL,
  `narration` text NOT NULL,
  `login_id` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tpstudent`
--

CREATE TABLE `tpstudent` (
  `STUDENTID` varchar(50) DEFAULT NULL,
  `ADM_DATE` date DEFAULT NULL,
  `ADM_NO` varchar(50) NOT NULL,
  `BIRTH_DT` date DEFAULT NULL,
  `TITLE_NM` varchar(50) DEFAULT NULL,
  `FIRST_NM` varchar(50) DEFAULT NULL,
  `MIDDLE_NM` varchar(50) DEFAULT NULL,
  `BLOOD_GRP` varchar(25) DEFAULT NULL,
  `CATEGORY` smallint(6) DEFAULT NULL,
  `SEX` smallint(6) DEFAULT NULL,
  `NATION` varchar(25) DEFAULT NULL,
  `EMP_WARD` varchar(255) DEFAULT NULL,
  `EMPID` varchar(25) DEFAULT NULL,
  `FATHER_NM` varchar(50) DEFAULT NULL,
  `MOTHER_NM` varchar(50) DEFAULT NULL,
  `LAST_SCH` varchar(50) DEFAULT NULL,
  `LSCH_ADD` varchar(150) DEFAULT NULL,
  `ADM_CLASS` smallint(6) DEFAULT NULL,
  `ADM_SEC` smallint(6) DEFAULT NULL,
  `SIB_NO` smallint(6) DEFAULT NULL,
  `PERM_ADD` varchar(150) DEFAULT NULL,
  `P_CITY` varchar(50) DEFAULT NULL,
  `P_STATE` varchar(50) DEFAULT NULL,
  `P_NATION` varchar(50) DEFAULT NULL,
  `P_PIN` varchar(50) DEFAULT NULL,
  `P_PHONE1` varchar(50) DEFAULT NULL,
  `P_PHONE2` varchar(50) DEFAULT NULL,
  `P_FAXNO` varchar(50) DEFAULT NULL,
  `P_MOBILE` varchar(50) DEFAULT NULL,
  `P_EMAIL` varchar(50) DEFAULT NULL,
  `CORR_ADD` varchar(150) DEFAULT NULL,
  `C_CITY` varchar(50) DEFAULT NULL,
  `C_STATE` varchar(50) DEFAULT NULL,
  `C_NATION` varchar(50) DEFAULT NULL,
  `C_PIN` varchar(50) DEFAULT NULL,
  `C_PHONE1` varchar(50) DEFAULT NULL,
  `C_PHONE2` varchar(50) DEFAULT NULL,
  `C_FAXNO` varchar(50) DEFAULT NULL,
  `C_MOBILE` varchar(50) DEFAULT NULL,
  `C_EMAIL` varchar(50) DEFAULT NULL,
  `HOUSE_CODE` smallint(6) DEFAULT NULL,
  `CLASS` smallint(6) DEFAULT NULL,
  `DISP_CLASS` varchar(25) DEFAULT NULL,
  `SEC` smallint(6) DEFAULT NULL,
  `DISP_SEC` varchar(10) DEFAULT NULL,
  `ROLL_NO` smallint(6) DEFAULT NULL,
  `BUS_NO` varchar(35) DEFAULT NULL,
  `STOPNO` smallint(6) DEFAULT NULL,
  `FREESHIP` tinyint(1) DEFAULT NULL,
  `SCHOLAR` tinyint(1) DEFAULT NULL,
  `LETTERNO` varchar(50) DEFAULT NULL,
  `LIB_FLAG` varchar(50) DEFAULT NULL,
  `ACT_FLAG` varchar(50) DEFAULT NULL,
  `TC_ISSUED` tinyint(1) DEFAULT NULL,
  `COMPUTER` tinyint(1) DEFAULT NULL,
  `HOSTEL` tinyint(1) DEFAULT NULL,
  `TC_NUMBER` varchar(50) DEFAULT NULL,
  `PAID_UPTO` smallint(6) DEFAULT NULL,
  `SESSIONID` varchar(50) DEFAULT NULL,
  `APR_FEE` varchar(50) DEFAULT NULL,
  `MAY_FEE` varchar(50) DEFAULT NULL,
  `JUNE_FEE` varchar(50) DEFAULT NULL,
  `JULY_FEE` varchar(50) DEFAULT NULL,
  `AUG_FEE` varchar(50) DEFAULT NULL,
  `SEP_FEE` varchar(50) DEFAULT NULL,
  `OCT_FEE` varchar(50) DEFAULT NULL,
  `NOV_FEE` varchar(50) DEFAULT NULL,
  `DEC_FEE` varchar(50) DEFAULT NULL,
  `JAN_FEE` varchar(50) DEFAULT NULL,
  `FEB_FEE` varchar(50) DEFAULT NULL,
  `MAR_FEE` varchar(50) DEFAULT NULL,
  `CBSE_REG` varchar(50) DEFAULT NULL,
  `CBSE_ROLL` varchar(50) DEFAULT NULL,
  `SUBJECT1` varchar(50) DEFAULT NULL,
  `SUBJECT2` varchar(50) DEFAULT NULL,
  `SUBJECT3` varchar(50) DEFAULT NULL,
  `SUBJECT4` varchar(50) DEFAULT NULL,
  `SUBJECT5` varchar(50) DEFAULT NULL,
  `SUBJECT6` varchar(50) DEFAULT NULL,
  `WORK_DAYS` smallint(6) DEFAULT NULL,
  `APR_ATT` smallint(6) DEFAULT NULL,
  `MAY_ATT` smallint(6) DEFAULT NULL,
  `JUNE_ATT` smallint(6) DEFAULT NULL,
  `JULY_ATT` smallint(6) DEFAULT NULL,
  `AUG_ATT` smallint(6) DEFAULT NULL,
  `SEP_ATT` smallint(6) DEFAULT NULL,
  `OCT_ATT` smallint(6) DEFAULT NULL,
  `NOV_ATT` smallint(6) DEFAULT NULL,
  `DEC_ATT` smallint(6) DEFAULT NULL,
  `JAN_ATT` smallint(6) DEFAULT NULL,
  `FEB_ATT` smallint(6) DEFAULT NULL,
  `MAR_ATT` smallint(6) DEFAULT NULL,
  `UPD_DATE` datetime DEFAULT NULL,
  `oldadmno` varchar(50) DEFAULT NULL,
  `religion` smallint(6) DEFAULT NULL,
  `math_lab` tinyint(1) DEFAULT NULL,
  `busno1` smallint(6) DEFAULT NULL,
  `BFEE` varchar(50) DEFAULT NULL,
  `BFEEType` tinyint(1) DEFAULT NULL,
  `HFEE` varchar(50) DEFAULT NULL,
  `Mag` tinyint(1) DEFAULT NULL,
  `Fee_Book_No` int(11) DEFAULT 0,
  `Bus_Book_No` varchar(100) DEFAULT NULL,
  `Student_Status` varchar(50) DEFAULT NULL,
  `RemID` int(11) NOT NULL DEFAULT 0,
  `VL` varchar(50) NOT NULL DEFAULT 'N/A',
  `VR` varchar(50) NOT NULL DEFAULT 'N/A',
  `DEN` varchar(50) NOT NULL DEFAULT 'N/A',
  `Height` int(11) NOT NULL DEFAULT 0,
  `Weight` int(11) NOT NULL DEFAULT 0,
  `Password` varchar(255) NOT NULL DEFAULT 'bachpan@2019',
  `student_image` varchar(500) NOT NULL,
  `Parent_password` varchar(500) NOT NULL DEFAULT 'bachpan@2019',
  `route_id` int(11) NOT NULL DEFAULT 0,
  `student_transport_facility_id` int(11) NOT NULL DEFAULT 0,
  `mid_session_admisson_status` tinyint(1) NOT NULL DEFAULT 0 COMMENT '	0=ADMISSION IN APR,1=ADMISSION IN MID SESSION',
  `Admission_month` varchar(50) NOT NULL DEFAULT '1',
  `mid_session_payment_status` varchar(50) NOT NULL DEFAULT 'N/A',
  `Counter_payment_status` tinyint(1) NOT NULL DEFAULT 0,
  `Login_Id` varchar(255) NOT NULL DEFAULT 'N/A'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `wing_master`
--

CREATE TABLE `wing_master` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `CAMPUS_MASTER_ID` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accg`
--
ALTER TABLE `accg`
  ADD PRIMARY KEY (`CAT_CODE`);

--
-- Indexes for table `adm_no`
--
ALTER TABLE `adm_no`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`app_id`);

--
-- Indexes for table `att_temp_save`
--
ALTER TABLE `att_temp_save`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `busnomaster`
--
ALTER TABLE `busnomaster`
  ADD PRIMARY KEY (`BusCode`);

--
-- Indexes for table `campus_master`
--
ALTER TABLE `campus_master`
  ADD PRIMARY KEY (`Campus_ID`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`Class_No`);

--
-- Indexes for table `class_section_wise_subject_allocation`
--
ALTER TABLE `class_section_wise_subject_allocation`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `daycoll`
--
ALTER TABLE `daycoll`
  ADD PRIMARY KEY (`RECT_NO`);

--
-- Indexes for table `driver_master`
--
ALTER TABLE `driver_master`
  ADD PRIMARY KEY (`Driver_ID`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feegeneration`
--
ALTER TABLE `feegeneration`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feegeneration_2324`
--
ALTER TABLE `feegeneration_2324`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feegeneration_bak_04092023`
--
ALTER TABLE `feegeneration_bak_04092023`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feehead`
--
ALTER TABLE `feehead`
  ADD PRIMARY KEY (`ACT_CODE`);

--
-- Indexes for table `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homework_adm_wise`
--
ALTER TABLE `homework_adm_wise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homework_cat_master`
--
ALTER TABLE `homework_cat_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `latefine_master`
--
ALTER TABLE `latefine_master`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `latest_news`
--
ALTER TABLE `latest_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `master`
--
ALTER TABLE `master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu_data_role`
--
ALTER TABLE `menu_data_role`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `misc_password`
--
ALTER TABLE `misc_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice_adm_wise`
--
ALTER TABLE `notice_adm_wise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_admno` (`admno`),
  ADD KEY `idx_notice_tbl_id` (`notice_tbl_id`);

--
-- Indexes for table `online_transaction`
--
ALTER TABLE `online_transaction`
  ADD PRIMARY KEY (`order_id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `payment_mode`
--
ALTER TABLE `payment_mode`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission_data`
--
ALTER TABLE `permission_data`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `previous_year_collection`
--
ALTER TABLE `previous_year_collection`
  ADD PRIMARY KEY (`RECT_NO`);

--
-- Indexes for table `role_master`
--
ALTER TABLE `role_master`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `school_setting`
--
ALTER TABLE `school_setting`
  ADD PRIMARY KEY (`S_No`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`section_no`);

--
-- Indexes for table `session_master`
--
ALTER TABLE `session_master`
  ADD PRIMARY KEY (`Session_ID`);

--
-- Indexes for table `short_recoverd_payment`
--
ALTER TABLE `short_recoverd_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stoppage`
--
ALTER TABLE `stoppage`
  ADD PRIMARY KEY (`STOPNO`);

--
-- Indexes for table `stop_amt`
--
ALTER TABLE `stop_amt`
  ADD PRIMARY KEY (`STOP_NO`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`ADM_NO`);

--
-- Indexes for table `student_2324`
--
ALTER TABLE `student_2324`
  ADD PRIMARY KEY (`ADM_NO`);

--
-- Indexes for table `student_20012024`
--
ALTER TABLE `student_20012024`
  ADD PRIMARY KEY (`ADM_NO`);

--
-- Indexes for table `student_attendance_type`
--
ALTER TABLE `student_attendance_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_transport_facility`
--
ALTER TABLE `student_transport_facility`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `stu_attendance_entry`
--
ALTER TABLE `stu_attendance_entry`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_admno` (`admno`),
  ADD KEY `idx_att_date` (`att_date`);

--
-- Indexes for table `temp_daycoll`
--
ALTER TABLE `temp_daycoll`
  ADD PRIMARY KEY (`RECT_NO`);

--
-- Indexes for table `tpstudent`
--
ALTER TABLE `tpstudent`
  ADD PRIMARY KEY (`ADM_NO`);

--
-- Indexes for table `wing_master`
--
ALTER TABLE `wing_master`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `att_temp_save`
--
ALTER TABLE `att_temp_save`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `campus_master`
--
ALTER TABLE `campus_master`
  MODIFY `Campus_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `class_section_wise_subject_allocation`
--
ALTER TABLE `class_section_wise_subject_allocation`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feegeneration`
--
ALTER TABLE `feegeneration`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feegeneration_2324`
--
ALTER TABLE `feegeneration_2324`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feegeneration_bak_04092023`
--
ALTER TABLE `feegeneration_bak_04092023`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homework`
--
ALTER TABLE `homework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homework_adm_wise`
--
ALTER TABLE `homework_adm_wise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `homework_cat_master`
--
ALTER TABLE `homework_cat_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `latest_news`
--
ALTER TABLE `latest_news`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `master`
--
ALTER TABLE `master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu_data_role`
--
ALTER TABLE `menu_data_role`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `misc_password`
--
ALTER TABLE `misc_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notice_adm_wise`
--
ALTER TABLE `notice_adm_wise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `online_transaction`
--
ALTER TABLE `online_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_mode`
--
ALTER TABLE `payment_mode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `short_recoverd_payment`
--
ALTER TABLE `short_recoverd_payment`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_transport_facility`
--
ALTER TABLE `student_transport_facility`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stu_attendance_entry`
--
ALTER TABLE `stu_attendance_entry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
