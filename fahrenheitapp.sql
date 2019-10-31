-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 03, 2019 at 01:24 PM
-- Server version: 5.7.27-0ubuntu0.16.04.1
-- PHP Version: 5.6.40-8+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fahrenheitapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `adka_calculations`
--

CREATE TABLE `adka_calculations` (
  `adka_calculations_id` int(11) NOT NULL,
  `unique_row_id` int(11) DEFAULT NULL,
  `tn_htIn` double NOT NULL,
  `tn_mtIn` double NOT NULL,
  `tn_ltIn` double NOT NULL,
  `cal_constants_id` int(11) NOT NULL,
  `qth_lt` double DEFAULT NULL,
  `qth_ht` double DEFAULT NULL,
  `qth_mt` double DEFAULT NULL,
  `cop_th` double DEFAULT NULL,
  `tn_htout` double DEFAULT NULL,
  `tn_mtout` double DEFAULT NULL,
  `tn_ltout` double DEFAULT NULL,
  `vf_ht` int(11) DEFAULT NULL,
  `vf_mt` int(11) DEFAULT NULL,
  `vf_lt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adka_calculations`
--

INSERT INTO `adka_calculations` (`adka_calculations_id`, `unique_row_id`, `tn_htIn`, `tn_mtIn`, `tn_ltIn`, `cal_constants_id`, `qth_lt`, `qth_ht`, `qth_mt`, `cop_th`, `tn_htout`, `tn_mtout`, `tn_ltout`, `vf_ht`, `vf_mt`, `vf_lt`) VALUES
(1, NULL, 80, 45.59552150537635, 19, 3, -1.17, 20.55, 19.38, -0.06, 72.74, 48.9, 19.35, 2500, 5100, 2900),
(2, NULL, 80, 45.59552150537635, 19, 3, -1.17, 20.55, 19.38, -0.06, 72.74, 48.9, 19.35, 2500, 5100, 2900),
(3, NULL, 80, 45.59552150537635, 19, 3, -1.17, 20.55, 19.38, -0.06, 72.74, 48.9, 19.35, 2500, 5100, 2900);

-- --------------------------------------------------------

--
-- Table structure for table `calculations`
--

CREATE TABLE `calculations` (
  `id` int(11) NOT NULL,
  `lt` double NOT NULL,
  `ht` double NOT NULL,
  `a` double NOT NULL,
  `b` double NOT NULL,
  `aa` double NOT NULL,
  `bb` double NOT NULL,
  `c` double NOT NULL,
  `type_data` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calculations`
--

INSERT INTO `calculations` (`id`, `lt`, `ht`, `a`, `b`, `aa`, `bb`, `c`, `type_data`) VALUES
(1, 19, 55, 82.26611808, -22.78945261, -0.384537143, 0.071239143, -0.001391714, 'sika'),
(2, 19, 65, 97.23643161, -26.42332883, -1.527698567, 0.149579172, -0.002729486, 'sika'),
(3, 19, 75, 98.94476193, -26.31965138, -0.812970971, 0.102875501, -0.001932875, 'sika'),
(4, 19, 85, 103.0140606, -27.16414344, -0.313774593, 0.06596927, -0.00128299, 'sika'),
(5, 19, 90, 106.3976002, -28.06395678, -0.307138409, 0.064219709, -0.001240628, 'sika'),
(6, 16, 55, 30.4510884, -7.605081628, 0.434914286, 0.013185214, -0.000407071, 'sika'),
(7, 16, 65, 88.07531149, -24.30450285, -1.910382057, 0.186595411, -0.003590904, 'sika'),
(8, 16, 75, 96.74792195, -26.48290646, -1.099287127, 0.125220784, -0.002415054, 'sika'),
(9, 16, 85, 97.8846888, -26.38546867, -0.223076271, 0.060590623, -0.001274497, 'sika'),
(10, 16, 90, 99.21125782, -26.38546867, 0.042594599, 0.041599343, -0.000948102, 'sika'),
(11, 13, 55, 80.61607919, -23.46849748, 0.450948571, 0.025877429, -0.000995143, 'sika'),
(12, 13, 65, 67.86341246, -18.87125697, 0.759694917, 0.010552492, -0.000807988, 'sika'),
(13, 13, 75, 72.7109385, -19.97833212, -0.94581635, 0.118111336, -0.002451526, 'sika'),
(14, 13, 85, 83.1149409, -22.72956191, -0.234680734, 0.064052853, -0.001447191, 'sika'),
(15, 13, 90, 83.71493459, -22.82289115, -0.081570301, 0.051823332, -0.001221905, 'sika'),
(16, 10, 55, 60.51289669, -17.91555805, 5.530834286, -0.325776286, 0.004857429, 'sika'),
(17, 10, 65, 54.77985602, -15.69981816, -0.653582857, 0.119840857, -0.003028286, 'sika'),
(18, 10, 75, 62.14021505, -17.59283097, -0.571934286, 0.099104286, -0.002361429, 'sika'),
(19, 10, 85, 66.17906882, -18.59440733, -0.303254286, 0.073448286, -0.001793429, 'sika'),
(20, 10, 90, 68.13319711, -19.10898989, 0.244402857, 0.032415143, -0.001039714, 'sika'),
(21, 19, 55, 123.3992, -34.1842, -0.384537142857146, 0.0712391428571431, -0.00139171428571429, 'sikax'),
(22, 19, 65, 145.8546, -39.635, -1.52769856668879, 0.149579171864632, -0.00272948639681487, 'sikax'),
(23, 19, 75, 148.4171, -39.4795, -0.812970971347044, 0.102875500653906, -0.00193287456901676, 'sikax'),
(24, 19, 85, 154.5211, -40.7462, -0.31377459279515, 0.0659692702889075, -0.0012829900368565, 'sikax'),
(25, 19, 90, 159.5964, -42.0959, -0.307138409226014, 0.0642197093330163, -0.0012406279396029, 'sikax'),
(26, 16, 55, 45.6766, -11.4076, 0.434914285714286, 0.0131852142857143, -0.00040707142857143, 'sikax'),
(27, 16, 65, 132.113, -36.4568, -1.91038205706703, 0.186595410749835, -0.00359090378234905, 'sikax'),
(28, 16, 75, 145.1219, -39.7244, -1.09928712674187, 0.125220784339748, -0.00241505374917054, 'sikax'),
(29, 16, 85, 146.827, -39.5782, -0.223076270736565, 0.0605906230922364, -0.00127449701393497, 'sikax'),
(30, 16, 90, 148.8169, -39.961, 0.042594598540145, 0.0415993430656935, -0.00094810218978102, 'sikax'),
(31, 13, 55, 120.9241, -35.2027, 0.450948571428579, 0.0258774285714281, -0.00099514285714285, 'sikax'),
(32, 13, 65, 101.7951, -28.3069, 0.75969491705375, 0.0105524923689449, -0.00080798805573988, 'sikax'),
(33, 13, 75, 109.0664, -29.9675, -0.945816350364964, 0.118111335766423, -0.00245152554744526, 'sikax'),
(34, 13, 85, 124.6724, -34.0943, -0.234680733718837, 0.0640528524978672, -0.00144719148734477, 'sikax'),
(35, 13, 90, 125.5724, -34.2343, -0.081570300502419, 0.0518233323537777, -0.00122190529908048, 'sikax'),
(36, 10, 55, 90.7693, -26.8733, 5.53083428571428, -0.325776285714285, 0.00485742857142857, 'sikax'),
(37, 10, 65, 82.1698, -23.5497, -0.653582857142844, 0.119840857142856, -0.0030282857142857, 'sikax'),
(38, 10, 75, 93.2103, -26.3892, -0.571934285714285, 0.0991042857142857, -0.00236142857142857, 'sikax'),
(39, 10, 85, 99.2686, -27.8916, -0.303254285714286, 0.0734482857142857, -0.00179342857142857, 'sikax'),
(40, 10, 90, 102.1998, -28.6635, 0.24440285714286, 0.0324151428571426, -0.00103971428571428, 'sikax'),
(41, 19, 55, 45.58744582, -12.40737864, 0.289416667, 0, 0.000227778, 'sikaeco'),
(42, 19, 65, 71.49832835, -19.44332932, -0.509025397, 0.078689286, -0.001490873, 'sikaeco'),
(43, 19, 75, 72.66152736, -19.36858483, -1.140339454, 0.123206457, -0.002232454, 'sikaeco'),
(44, 19, 85, 76.67892717, -20.25976094, -0.582088782, 0.081247386, -0.001478427, 'sikaeco'),
(45, 19, 90, 74.53921171, -19.53272677, -0.299153897, 0.061453206, -0.001150125, 'sikaeco'),
(46, 16, 55, 46.22807546, -12.8781724, 0.286866944, 0, 0.000279722, 'sikaeco'),
(47, 16, 65, 62.19611396, -17.08575626, -1.565862266, 0.160267118, -0.003085183, 'sikaeco'),
(48, 16, 75, 67.10365712, -18.18130426, -1.30789761, 0.137539391, -0.00257132, 'sikaeco'),
(49, 16, 85, 63.57927097, -16.90837614, -0.293515075, 0.06319892, -0.001253531, 'sikaeco'),
(50, 16, 90, 67.56198903, -17.9406374, -0.31074044, 0.063609162, -0.001255352, 'sikaeco'),
(51, 13, 55, 40.92343338, -11.63331022, 0.598855449, 0, -0.000213782, 'sikaeco'),
(52, 13, 65, 48.09546559, -13.31987267, -0.516142496, 0.092694924, -0.002098214, 'sikaeco'),
(53, 13, 75, 56.09500645, -15.35054323, -0.693465063, 0.099225564, -0.002066814, 'sikaeco'),
(54, 13, 85, 60.59995481, -16.45007218, -0.430261856, 0.075987359, -0.001595776, 'sikaeco'),
(55, 13, 90, 60.70997949, -16.4058394, -0.252174856, 0.061062047, -0.001300921, 'sikaeco'),
(56, 10, 55, 44.68930636, -13.01180567, 0.552054167, 0, -0.000259722, 'sikaeco'),
(57, 10, 65, 40.79306323, -11.55379433, -0.56843254, 0.102899206, -0.002468254, 'sikaeco'),
(58, 10, 75, 47.06947005, -13.21044099, -0.143378571, 0.06476246, -0.001633413, 'sikaeco'),
(59, 10, 85, 50.26630696, -14.02617106, -0.773238095, 0.104313095, -0.002237698, 'sikaeco'),
(60, 10, 90, 39.37546441, -10.68968861, 0.182966667, 0.035279444, -0.001005, 'sikaeco'),
(61, 19, 55, 72.93991331, -19.85180582, 0.289416667, 0, 0.000227778, 'sikaxeco'),
(62, 19, 65, 114.3973254, -31.1093269, -0.509025397, 0.078689286, -0.001490873, 'sikaxeco'),
(63, 19, 75, 116.2584438, -30.98973572, -1.140339454, 0.123206457, -0.002232454, 'sikaxeco'),
(64, 19, 85, 122.6862835, -32.4156175, -0.582088782, 0.081247386, -0.001478427, 'sikaxeco'),
(65, 19, 90, 119.2627387, -31.25236284, -0.299153897, 0.061453206, -0.001150125, 'sikaxeco'),
(66, 16, 55, 73.96492074, -20.60507583, 0.286866944, 0, 0.000279722, 'sikaxeco'),
(67, 16, 65, 99.51378234, -27.33721002, -1.565862266, 0.160267118, -0.003085183, 'sikaxeco'),
(68, 16, 75, 107.3658514, -29.09008681, -1.30789761, 0.137539391, -0.00257132, 'sikaxeco'),
(69, 16, 85, 101.7268335, -27.05340183, -0.293515075, 0.06319892, -0.001253531, 'sikaxeco'),
(70, 16, 90, 108.0991824, -28.70501984, -0.31074044, 0.063609162, -0.001255352, 'sikaxeco'),
(71, 13, 55, 65.4774934, -18.61329636, 0.598855449, 0, -0.000213782, 'sikaxeco'),
(72, 13, 65, 76.95274495, -21.31179627, -0.516142496, 0.092694924, -0.002098214, 'sikaxeco'),
(73, 13, 75, 89.75201032, -24.56086916, -0.693465063, 0.099225564, -0.002066814, 'sikaxeco'),
(74, 13, 85, 96.95992769, -26.32011549, -0.430261856, 0.075987359, -0.001595776, 'sikaxeco'),
(75, 13, 90, 97.13596718, -26.24934304, -0.252174856, 0.061062047, -0.001300921, 'sikaxeco'),
(76, 10, 55, 71.50289018, -20.81888907, 0.552054167, 0, -0.000259722, 'sikaxeco'),
(77, 10, 65, 65.26890118, -18.48607093, -0.56843254, 0.102899206, -0.002468254, 'sikaxeco'),
(78, 10, 75, 75.31115208, -21.13670558, -0.143378571, 0.06476246, -0.001633413, 'sikaxeco'),
(79, 10, 85, 80.42609114, -22.44187369, -0.773238095, 0.104313095, -0.002237698, 'sikaxeco'),
(80, 10, 90, 63.00074305, -17.10350178, 0.182966667, 0.035279444, -0.001005, 'sikaxeco');

-- --------------------------------------------------------

--
-- Table structure for table `cal_constants`
--

CREATE TABLE `cal_constants` (
  `cal_constants_id` int(11) NOT NULL,
  `chiller_type` varchar(55) NOT NULL,
  `mod_types_id` int(11) NOT NULL,
  `n_AsHt` int(11) NOT NULL,
  `n_ApHt` int(11) NOT NULL,
  `n_AsLt` int(11) NOT NULL,
  `n_ApLt` int(11) NOT NULL,
  `total_module` int(11) NOT NULL,
  `qel_nomht` float(11,2) NOT NULL,
  `qel_nomlt` float(11,2) NOT NULL,
  `qel_nommt` float(11,2) NOT NULL,
  `circuit_separation` varchar(255) NOT NULL,
  `re_cooler` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cal_constants`
--

INSERT INTO `cal_constants` (`cal_constants_id`, `chiller_type`, `mod_types_id`, `n_AsHt`, `n_ApHt`, `n_AsLt`, `n_ApLt`, `total_module`, `qel_nomht`, `qel_nomlt`, `qel_nommt`, `circuit_separation`, `re_cooler`) VALUES
(1, 'eCoo10', 1, 1, 1, 1, 1, 1, 82.47, 300.00, 223.36, 'ST10', 'eRec 10 | 40'),
(2, 'eCoo20', 1, 1, 2, 1, 2, 2, 164.94, 600.00, 446.72, 'ST20', 'eRec 20 | 80'),
(3, 'eCoo30', 1, 1, 3, 1, 3, 3, 247.41, 900.00, 670.08, 'ST20X', 'eRec 30 | 120'),
(4, 'eCoo10X', 2, 1, 1, 1, 1, 1, 93.69, 350.00, 260.58, 'ST10X', 'eRec 20 | 80'),
(5, 'eCoo20X', 2, 1, 2, 1, 2, 2, 187.38, 700.00, 521.16, 'ST20X', 'eRec 30 | 120'),
(6, 'eCoo30X', 2, 1, 3, 1, 3, 3, 281.07, 1050.00, 781.74, 'ST30X', 'eRec 50 | 200'),
(7, 'eCoo40X', 2, 1, 4, 1, 4, 4, 374.76, 1400.00, 1042.32, 'ST40X', 'eRec 60 | 240');

-- --------------------------------------------------------

--
-- Table structure for table `chillers`
--

CREATE TABLE `chillers` (
  `chiller_id` int(11) NOT NULL,
  `fahrenheit_id` int(11) NOT NULL,
  `chiller_chiller_type` varchar(11) NOT NULL,
  `chiller_adsorbent` varchar(11) NOT NULL,
  `chiller_product` varchar(11) NOT NULL,
  `chiller_no_chiller` int(11) NOT NULL,
  `chiller_product_inter` int(11) NOT NULL,
  `chiller_group_inter` int(11) NOT NULL,
  `addchiller_investment_cost` int(11) DEFAULT NULL,
  `addchiller_discount` int(11) DEFAULT NULL,
  `addchiller_maintenence` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chillers`
--

INSERT INTO `chillers` (`chiller_id`, `fahrenheit_id`, `chiller_chiller_type`, `chiller_adsorbent`, `chiller_product`, `chiller_no_chiller`, `chiller_product_inter`, `chiller_group_inter`, `addchiller_investment_cost`, `addchiller_discount`, `addchiller_maintenence`) VALUES
(1, 2, 'Adsorption', 'Silica gel', 'eCoo 20 ST', 3, 2, 2, NULL, NULL, NULL),
(2, 3, 'Adsorption', 'Silica gel', 'eCoo 20 ST', 3, 2, 2, NULL, NULL, NULL),
(3, 4, 'Adsorption', 'Silica gel', 'eCoo 20 ST', 3, 2, 2, NULL, NULL, NULL),
(4, 5, 'Adsorption', 'Silica gel', 'eCoo 20 ST', 3, 2, 2, NULL, NULL, NULL),
(5, 6, 'Adsorption', 'Silica gel', 'eCoo 20 ST', 3, 2, 2, 3, 3, 3),
(6, 7, 'Adsorption', 'Silica gel', 'eCoo 20 ST', 3, 2, 2, 3, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `compression_chillers`
--

CREATE TABLE `compression_chillers` (
  `compression_chillers_id` int(11) NOT NULL,
  `unique_row_id` int(11) NOT NULL,
  `chillername` varchar(255) DEFAULT NULL,
  `refrigerant` varchar(255) DEFAULT NULL,
  `manufacturer` varchar(55) DEFAULT NULL,
  `compressor` varchar(55) DEFAULT NULL,
  `temperature` int(11) DEFAULT NULL,
  `investment_cost` int(11) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `maintenence_costs` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compression_chillers`
--

INSERT INTO `compression_chillers` (`compression_chillers_id`, `unique_row_id`, `chillername`, `refrigerant`, `manufacturer`, `compressor`, `temperature`, `investment_cost`, `discount`, `maintenence_costs`) VALUES
(1, 31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 76, 'chiler 3', 'R134a', 'unknown', 'unknown', NULL, NULL, NULL, NULL),
(7, 77, 'chiler 3', 'R134a', 'unknown', 'unknown', NULL, NULL, NULL, NULL),
(8, 91, 'chiler 3', 'R134a', 'unknown', 'unknown', NULL, NULL, NULL, NULL),
(9, 100, 'chillr2', 'R134a', 'option1', 'option1', 3, 33, 33, 33),
(10, 101, 'chillr2', 'R134a', 'option1', 'option1', 3, 33, 33, 33),
(11, 127, 'chiller 1', 'R134a', 'unknown', 'unknown', NULL, NULL, NULL, NULL),
(12, 128, 'chiller 1', 'R134a', 'option1', 'option1', 55, NULL, NULL, NULL),
(13, 31, NULL, 'R134a', 'unknown', 'unknown', 45, NULL, NULL, NULL),
(14, 32, NULL, 'R134a', 'unknown', 'unknown', 45, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cooling_load_profiles`
--

CREATE TABLE `cooling_load_profiles` (
  `cooling_load_profiles_id` int(11) NOT NULL,
  `unique_row_id` int(11) NOT NULL,
  `cooling_radiant_cooling_office` varchar(255) DEFAULT NULL,
  `cooling_profile_type` varchar(255) NOT NULL,
  `cooling_cooling_other` int(11) DEFAULT NULL,
  `cooling_max_cooling_load` int(11) NOT NULL,
  `cooling_max_cooling_load_at` int(11) DEFAULT NULL,
  `cooling_base_load_to` int(11) DEFAULT NULL,
  `cooling_base_load_from` int(11) DEFAULT NULL,
  `cooling_zero_load_from` int(11) DEFAULT NULL,
  `cooling_zero_load_to` int(11) DEFAULT NULL,
  `cooling_cooling_hours` int(11) DEFAULT NULL,
  `cooling_investment_cost` int(11) DEFAULT NULL,
  `cooling_investment_discount` int(11) DEFAULT NULL,
  `cooling_maintenance_cost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cooling_load_profiles`
--

INSERT INTO `cooling_load_profiles` (`cooling_load_profiles_id`, `unique_row_id`, `cooling_radiant_cooling_office`, `cooling_profile_type`, `cooling_cooling_other`, `cooling_max_cooling_load`, `cooling_max_cooling_load_at`, `cooling_base_load_to`, `cooling_base_load_from`, `cooling_zero_load_from`, `cooling_zero_load_to`, `cooling_cooling_hours`, `cooling_investment_cost`, `cooling_investment_discount`, `cooling_maintenance_cost`) VALUES
(1, 23, NULL, 'Office Space', NULL, 2, NULL, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 24, NULL, 'Office Space', NULL, 2, NULL, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 25, NULL, 'Office Space', NULL, 2, NULL, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 26, NULL, 'Office Space', NULL, 2, NULL, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 27, NULL, 'Office Space', NULL, 3, NULL, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 28, NULL, 'Office Space', NULL, 2, NULL, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 29, NULL, 'Office Space', NULL, 2, NULL, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 30, NULL, 'Office Space', NULL, 2, NULL, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 31, NULL, 'Office Space', NULL, 2, NULL, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 32, NULL, 'Office Space', NULL, 2, NULL, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 33, NULL, 'Office Space', NULL, 2, NULL, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 34, NULL, 'Office Space', NULL, 2, NULL, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 35, NULL, 'Office Space', NULL, 2, NULL, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 84, 'radiant', 'Process cooling', 22, 22, NULL, 22, 22, 22, 22, 22, NULL, NULL, NULL),
(15, 85, 'radiant', 'Process cooling', 22, 22, NULL, 22, 22, 22, 22, 22, NULL, NULL, NULL),
(16, 86, 'radiant', 'Process cooling', 22, 22, NULL, 22, 22, 22, 22, 22, NULL, NULL, NULL),
(17, 87, 'radiant', 'Process cooling', 22, 22, NULL, 22, 22, 22, 22, 22, NULL, NULL, NULL),
(18, 88, 'radiant', 'Process cooling', 22, 22, NULL, 22, 22, 22, 22, 22, NULL, NULL, NULL),
(19, 89, 'radiant', 'Process cooling', 22, 22, NULL, 22, 22, 22, 22, 22, NULL, NULL, NULL),
(20, 90, 'radiant', 'Process cooling', 22, 22, NULL, 22, 22, 22, 22, 22, NULL, NULL, NULL),
(21, 91, 'radiant', 'Process cooling', 22, 22, NULL, 22, 22, 22, 22, 22, NULL, NULL, NULL),
(22, 92, 'radiant', 'Process cooling', 22, 22, NULL, 22, 22, 22, 22, 22, NULL, NULL, NULL),
(23, 100, 'cooling', 'Office Space', 33, 3, NULL, 33, 33, 33, 3, 33, 33, 33, 33),
(24, 101, 'cooling', 'Office Space', 33, 3, NULL, 33, 33, 33, 3, 33, 33, 33, 33),
(25, 126, NULL, 'Process cooling', NULL, 2, NULL, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 127, NULL, 'Process cooling', NULL, 2, NULL, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 128, NULL, 'Process cooling', NULL, 2, NULL, 2, 2, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 30, NULL, 'Process cooling', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 30, NULL, 'Process cooling', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 31, 'fd', 'Process cooling', NULL, 545, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 31, 'fd', 'Process cooling', NULL, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 32, 'fd', 'Process cooling', NULL, 545, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 32, 'fd', 'Process cooling', NULL, 22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 33, 'da', 'Process cooling', NULL, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 34, NULL, 'Process cooling', NULL, 1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 35, NULL, 'Process cooling', NULL, 22, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 36, 'ewqeqw', 'Process cooling', NULL, 121, 67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 40, NULL, 'Process cooling', NULL, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 41, NULL, 'Process cooling', NULL, 56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 42, NULL, 'Hot Water Demand', NULL, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `economic_datas`
--

CREATE TABLE `economic_datas` (
  `economic_datas_id` int(11) NOT NULL,
  `unique_row_id` int(11) NOT NULL,
  `electric_price` int(11) DEFAULT NULL,
  `heat_price` int(11) DEFAULT NULL,
  `electric_price_increased` int(11) DEFAULT NULL,
  `calculated_interest_rate` int(11) DEFAULT NULL,
  `inflation_rate` int(11) DEFAULT NULL,
  `own_usage_of_electricity` int(11) DEFAULT NULL,
  `subsidy_for_electricity` int(11) DEFAULT NULL,
  `gas_price` int(11) DEFAULT NULL,
  `electricity_sales_price` int(11) DEFAULT NULL,
  `energy_tax_refund` int(11) DEFAULT NULL,
  `eeg_allocation_portion` int(11) DEFAULT NULL,
  `eeg_apportion_costs` int(11) DEFAULT NULL,
  `chp_basement` int(11) DEFAULT NULL,
  `discount_chp_basement` int(11) DEFAULT NULL,
  `chiller` int(11) DEFAULT NULL,
  `chiller_discount` int(11) DEFAULT NULL,
  `radiant_cooling_office` int(11) DEFAULT NULL,
  `radiant_discount` int(11) DEFAULT NULL,
  `ecoo` int(11) DEFAULT NULL,
  `ecoo_discount` int(11) DEFAULT NULL,
  `chp_basement_maintenence` int(11) DEFAULT NULL,
  `chiller_maintenence` int(11) DEFAULT NULL,
  `radiant_maintenence` int(11) DEFAULT NULL,
  `ecoo_maintenence` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `economic_datas`
--

INSERT INTO `economic_datas` (`economic_datas_id`, `unique_row_id`, `electric_price`, `heat_price`, `electric_price_increased`, `calculated_interest_rate`, `inflation_rate`, `own_usage_of_electricity`, `subsidy_for_electricity`, `gas_price`, `electricity_sales_price`, `energy_tax_refund`, `eeg_allocation_portion`, `eeg_apportion_costs`, `chp_basement`, `discount_chp_basement`, `chiller`, `chiller_discount`, `radiant_cooling_office`, `radiant_discount`, `ecoo`, `ecoo_discount`, `chp_basement_maintenence`, `chiller_maintenence`, `radiant_maintenence`, `ecoo_maintenence`) VALUES
(1, 36, 3, 3, 3, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 37, 3, 3, 3, 3, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 54, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 58, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 63, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 64, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 65, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 66, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 67, 12, 23, 3, 3242, 23423, 23423, 4234, 234234, 234234, 23432, 42342, 34, 234, 3, 3434, 34, 33, 44, 234, 34, 3343, 434, 234234, 2342),
(25, 68, 12, 23, 3, 3242, 23423, 23423, 4234, 234234, 234234, 23432, 42342, 34, 234, 3, 3434, 34, 33, 44, 234, 34, 3343, 434, 234234, 2342),
(26, 69, 12, 23, 3, 3242, 23423, 23423, 4234, 234234, 234234, 23432, 42342, 34, 234, 3, 3434, 34, 33, 44, 234, 34, 3343, 434, 234234, 2342),
(27, 70, 12, 23, 3, 3242, 23423, 23423, 4234, 234234, 234234, 23432, 42342, 34, 234, 3, 3434, 34, 33, 44, 234, 34, 3343, 434, 234234, 2342),
(28, 71, 12, 23, 3, 3242, 23423, 23423, 4234, 234234, 234234, 23432, 42342, 34, 234, 3, 3434, 34, 33, 44, 234, 34, 3343, 434, 234234, 2342),
(29, 72, 12, 23, 3, 3242, 23423, 23423, 4234, 234234, 234234, 23432, 42342, 34, 234, 3, 3434, 34, 33, 44, 234, 34, 3343, 434, 234234, 2342),
(30, 73, 12, 23, 3, 3242, 23423, 23423, 4234, 234234, 234234, 23432, 42342, 34, 234, 3, 3434, 34, 33, 44, 234, 34, 3343, 434, 234234, 2342),
(31, 74, 12, 23, 3, 3242, 23423, 23423, 4234, 234234, 234234, 23432, 42342, 34, 234, 3, 3434, 34, 33, 44, 234, 34, 3343, 434, 234234, 2342),
(32, 75, 12, 23, 3, 3242, 23423, 23423, 4234, 234234, 234234, 23432, 42342, 34, 234, 3, 3434, 34, 33, 44, 234, 34, 3343, 434, 234234, 2342),
(33, 76, 12, 23, 3, 3242, 23423, 23423, 4234, 234234, 234234, 23432, 42342, 34, 234, 3, 3434, 34, 33, 44, 234, 34, 3343, 434, 234234, 2342),
(34, 77, 12, 23, 3, 3242, 23423, 23423, 4234, 234234, 234234, 23432, 42342, 34, 234, 3, 3434, 34, 33, 44, 234, 34, 3343, 434, 234234, 2342),
(35, 78, 12, 23, 3, 3242, 23423, 23423, 4234, 234234, 234234, 23432, 42342, 34, 234, 3, 3434, 34, 33, 44, 234, 34, 3343, 434, 234234, 2342),
(36, 84, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 85, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 86, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 88, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(43, 91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(44, 92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(45, 93, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(46, 94, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(47, 95, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(48, 96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(49, 97, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(50, 98, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(51, 99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(52, 100, 2, 2, 2, 2, 2, 2, 2016, 336, 79879, 4646, 50, 45465, 8458, NULL, 5588, NULL, 555, NULL, 244, NULL, 464, 3164, 64498, 46468),
(53, 101, 2, 2, 2, 2, 2, 2, 2016, 336, 79879, 4646, 50, 45465, 8458, NULL, 5588, NULL, 555, NULL, 244, NULL, 464, 3164, 64498, 46468),
(54, 102, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(55, 103, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(56, 104, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(57, 105, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(58, 106, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(59, 107, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(60, 108, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(61, 109, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(62, 110, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(63, 111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(64, 112, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(65, 113, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(66, 114, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(67, 115, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(68, 116, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(69, 117, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(70, 118, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(71, 119, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(72, 120, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(73, 121, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(74, 122, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(75, 123, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(76, 124, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(77, 125, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(78, 126, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(79, 127, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(80, 128, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(81, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(82, 30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(83, 31, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(84, 32, 13, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(85, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(86, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(87, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(88, 36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(89, 37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(90, 38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(91, 39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(92, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(93, 41, 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(94, 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `economic_data_additional_infos`
--

CREATE TABLE `economic_data_additional_infos` (
  `economic_data_additional_infos_id` int(11) NOT NULL,
  `economic_data_id` int(11) NOT NULL,
  `tab_name` varchar(255) DEFAULT NULL,
  `additional_field_name` varchar(255) DEFAULT NULL,
  `additional_field_value` int(11) DEFAULT NULL,
  `additional_field_discount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `economic_data_additional_infos`
--

INSERT INTO `economic_data_additional_infos` (`economic_data_additional_infos_id`, `economic_data_id`, `tab_name`, `additional_field_name`, `additional_field_value`, `additional_field_discount`) VALUES
(1, 19, 'general', 'eeg_apportion_cost', 323, NULL),
(2, 19, 'general', 'eeg_apportion_cost', 3234, NULL),
(3, 19, 'chp', 'eeg_chp_apportion_costs', 22, NULL),
(4, 19, 'chp', 'eeg_chp_apportion_costs', 6435, NULL),
(5, 19, 'investment', 'planning', 324, 2342),
(6, 19, 'investment', 'planning', 2, 234),
(7, 19, 'maintenence', 'maintenence', 44, 234),
(8, 19, 'maintenence', 'maintenence', 555, 234),
(9, 20, 'general', 'eeg_apportion_cost', 323, NULL),
(10, 20, 'general', 'eeg_apportion_cost', 3234, NULL),
(11, 20, 'chp', 'eeg_chp_apportion_costs', 22, NULL),
(12, 20, 'chp', 'eeg_chp_apportion_costs', 6435, NULL),
(13, 20, 'investment', 'planning', 324, 2342),
(14, 20, 'investment', 'planning', 2, 234),
(15, 20, 'maintenence', 'maintenence', 44, 234),
(16, 20, 'maintenence', 'maintenence', 555, 234),
(17, 21, 'general', 'eeg_apportion_cost', 323, NULL),
(18, 21, 'general', 'eeg_apportion_cost', 3234, NULL),
(19, 21, 'chp', 'eeg_chp_apportion_costs', 22, NULL),
(20, 21, 'chp', 'eeg_chp_apportion_costs', 6435, NULL),
(21, 21, 'investment', 'planning', 324, 2342),
(22, 21, 'investment', 'planning', 2, 234),
(23, 22, 'general', 'eeg_apportion_cost', 323, NULL),
(24, 22, 'general', 'eeg_apportion_cost', 3234, NULL),
(25, 22, 'chp', 'eeg_chp_apportion_costs', 22, NULL),
(26, 22, 'chp', 'eeg_chp_apportion_costs', 6435, NULL),
(27, 22, 'investment', 'planning', 324, 2342),
(28, 22, 'investment', 'planning', 2, 234),
(29, 22, 'maintenence', 'maintenence', 44, NULL),
(30, 22, 'maintenence', 'maintenence', 555, NULL),
(31, 23, 'general', 'eeg_apportion_cost', 323, NULL),
(32, 23, 'general', 'eeg_apportion_cost', 3234, NULL),
(33, 23, 'chp', 'eeg_chp_apportion_costs', 22, NULL),
(34, 23, 'chp', 'eeg_chp_apportion_costs', 6435, NULL),
(35, 23, 'investment', 'planning', 324, 2342),
(36, 23, 'investment', 'planning', 2, 234),
(37, 23, 'maintenence', 'maintenence', 44, NULL),
(38, 23, 'maintenence', 'maintenence', 555, NULL),
(39, 28, 'investment', 'planning', 3423, 23),
(40, 28, 'maintenence', 'maintenence', 4234, NULL),
(41, 29, 'investment', 'planning', 3423, 23),
(42, 29, 'maintenence', 'maintenence', 4234, NULL),
(43, 30, 'investment', 'planning', 3423, 23),
(44, 30, 'maintenence', 'maintenence', 4234, NULL),
(45, 31, 'investment', 'planning', 3423, 23),
(46, 31, 'maintenence', 'maintenence', 4234, NULL),
(47, 32, 'investment', 'planning', 3423, 23),
(48, 32, 'maintenence', 'maintenence', 4234, NULL),
(49, 33, 'investment', 'planning', 3423, 23),
(50, 33, 'maintenence', 'maintenence', 4234, NULL),
(51, 34, 'investment', 'planning', 3423, 23),
(52, 34, 'maintenence', 'maintenence', 4234, NULL),
(53, 35, 'investment', 'planning', 3423, 23),
(54, 35, 'maintenence', 'maintenence', 4234, NULL),
(55, 52, 'investment', 'planning', 321, 2),
(56, 52, 'investment', 'planning', 68552, 2),
(57, 52, 'maintenence', 'maintenence', 644, NULL),
(58, 52, 'maintenence', 'maintenence', 46498, NULL),
(59, 53, 'investment', 'planning', 321, 2),
(60, 53, 'investment', 'planning', 68552, 2),
(61, 53, 'maintenence', 'maintenence', 644, NULL),
(62, 53, 'maintenence', 'maintenence', 46498, NULL),
(63, 65, 'general', 'general 1', NULL, NULL),
(64, 65, 'general', 'general 2', NULL, NULL),
(65, 65, 'chp', 'Enter field label', NULL, NULL),
(66, 65, 'chp', 'Enter field label', NULL, NULL),
(67, 66, 'general', 'general 1', NULL, NULL),
(68, 78, 'general', 'gen 1', 1, NULL),
(69, 78, 'general', 'gen 2', 2, NULL),
(70, 78, 'chp', 'Enter field label', 3, NULL),
(71, 78, 'chp', 'Enter field label', 4, NULL),
(72, 78, 'investment', 'inv 1', 5, 5),
(73, 78, 'investment', 'inv 2', 6, 6),
(74, 78, 'investment', 'inv 3', 7, 7),
(75, 78, 'maintenence', 'main 1', 8, NULL),
(76, 78, 'maintenence', 'main 2', 9, NULL),
(77, 79, 'general', 'gen 1', 1, NULL),
(78, 79, 'general', 'gen 2', 2, NULL),
(79, 79, 'chp', 'Enter field label', 3, NULL),
(80, 79, 'chp', 'Enter field label', 4, NULL),
(81, 79, 'investment', 'inv 1', 5, 5),
(82, 79, 'investment', 'inv 2', 6, 6),
(83, 79, 'investment', 'inv 3', 7, 7),
(84, 79, 'maintenence', 'main 1', 8, NULL),
(85, 79, 'maintenence', 'main 2', 9, NULL),
(86, 80, 'general', 'gen 1', 1, NULL),
(87, 80, 'general', 'gen 2', 2, NULL),
(88, 80, 'chp', 'Enter field label', 3, NULL),
(89, 80, 'chp', 'Enter field label', 4, NULL),
(90, 80, 'investment', 'inv 1', 5, 5),
(91, 80, 'investment', 'inv 2', 6, 6),
(92, 80, 'investment', 'inv 3', 7, 7),
(93, 80, 'maintenence', 'main 1', 8, NULL),
(94, 80, 'maintenence', 'main 2', 9, NULL),
(95, 83, 'investment', 'Enter field label', NULL, NULL),
(96, 83, 'maintenence', 'Enter field label', NULL, NULL),
(97, 84, 'investment', 'Enter field label', NULL, NULL),
(98, 84, 'maintenence', 'Enter field label', NULL, NULL),
(99, 93, 'investment', 'Enter field label', NULL, NULL),
(100, 93, 'maintenence', 'Enter field label', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `fahrenheits`
--

CREATE TABLE `fahrenheits` (
  `fahrenheit_id` int(11) NOT NULL,
  `unique_row_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fahrenheits`
--

INSERT INTO `fahrenheits` (`fahrenheit_id`, `unique_row_id`) VALUES
(1, 88),
(2, 89),
(3, 90),
(4, 91),
(5, 92),
(6, 100),
(7, 101),
(8, 126),
(9, 127),
(10, 128),
(11, 30),
(12, 31),
(13, 32),
(14, 33),
(15, 34),
(16, 35),
(17, 36),
(18, 40),
(19, 41),
(20, 42);

-- --------------------------------------------------------

--
-- Table structure for table `general_informations`
--

CREATE TABLE `general_informations` (
  `general_informations_id` int(11) NOT NULL,
  `unique_row_id` int(11) NOT NULL,
  `project_number` varchar(255) DEFAULT NULL,
  `project_name` varchar(255) DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `customer` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `phone_number` varchar(55) DEFAULT NULL,
  `email_address` varchar(255) NOT NULL,
  `editor` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `address` varchar(255) NOT NULL,
  `personal_phone_number` varchar(55) DEFAULT NULL,
  `mobile_number` varchar(55) DEFAULT NULL,
  `personal_email_address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `general_informations`
--

INSERT INTO `general_informations` (`general_informations_id`, `unique_row_id`, `project_number`, `project_name`, `location`, `customer`, `contact`, `phone_number`, `email_address`, `editor`, `company`, `address`, `personal_phone_number`, `mobile_number`, `personal_email_address`) VALUES
(1, 83, '007', 'Rajnikant project', 'London, UK', NULL, NULL, '9582222957', 'shaan.gola@gmail.com', 'shanti gola', 'Prospus Testing', 'Holland, MI, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(2, 84, '007', 'Rajnikant project', 'London, UK', NULL, NULL, '9582222957', 'shaan.gola@gmail.com', 'shanti gola', 'Prospus Testing', 'Holland, MI, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(3, 85, '007', 'Rajnikant project', 'London, UK', NULL, NULL, '9582222957', 'shaan.gola@gmail.com', 'shanti gola', 'Prospus Testing', 'Holland, MI, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(4, 86, '007', 'Rajnikant project', 'London, UK', NULL, NULL, '9582222957', 'shaan.gola@gmail.com', 'shanti gola', 'Prospus Testing', 'Holland, MI, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(5, 87, '007', 'Rajnikant project', 'London, UK', NULL, NULL, '9582222957', 'shaan.gola@gmail.com', 'shanti gola', 'Prospus Testing', 'Holland, MI, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(6, 88, '007', 'Rajnikant project', 'London, UK', NULL, NULL, '9582222957', 'shaan.gola@gmail.com', 'shanti gola', 'Prospus Testing', 'Holland, MI, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(7, 89, '007', 'Rajnikant project', 'London, UK', NULL, NULL, '9582222957', 'shaan.gola@gmail.com', 'shanti gola', 'Prospus Testing', 'Holland, MI, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(8, 90, '007', 'Rajnikant project', 'London, UK', NULL, NULL, '9582222957', 'shaan.gola@gmail.com', 'shanti gola', 'Prospus Testing', 'Holland, MI, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(9, 91, '007', 'Rajnikant project', 'London, UK', NULL, NULL, '9582222957', 'shaan.gola@gmail.com', 'shanti gola', 'Prospus Testing', 'Holland, MI, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(10, 92, '007', 'Rajnikant project', 'London, UK', NULL, NULL, '9582222957', 'shaan.gola@gmail.com', 'shanti gola', 'Prospus Testing', 'Holland, MI, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(11, 93, '007', 'Rajnikant project', 'London, UK', NULL, NULL, '9582222957', 'shaan.gola@gmail.com', 'shanti gola', 'Prospus Testing', 'Holland, MI, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(12, 94, '007', 'Rajnikant project', 'London, UK', NULL, NULL, '9582222957', 'shaan.gola@gmail.com', 'shanti gola', 'Prospus Testing', 'Holland, MI, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(13, 95, '007', 'Rajnikant project', 'London, UK', NULL, NULL, '9582222957', 'shaan.gola@gmail.com', 'shanti gola', 'Prospus Testing', 'Holland, MI, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(14, 96, '007', 'Rajnikant project', 'London, UK', NULL, NULL, '9582222957', 'shaan.gola@gmail.com', 'shanti gola', 'Prospus Testing', 'Holland, MI, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(15, 97, '007', 'Rajnikant project', 'London, UK', NULL, NULL, '9582222957', 'shaan.gola@gmail.com', 'shanti gola', 'Prospus Testing', 'Holland, MI, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(16, 98, '007', 'Rajnikant project', 'London, UK', NULL, NULL, '9582222957', 'shaan.gola@gmail.com', 'shanti gola', 'Prospus Testing', 'Holland, MI, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(17, 99, '007', 'Rajnikant project', 'London, UK', NULL, NULL, '9582222957', 'shaan.gola@gmail.com', 'shanti gola', 'Prospus Testing', 'Holland, MI, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(18, 100, 'New project 011', 'Test project', 'New York, NY, USA', 'shanti gola', NULL, '9582222957', 'shaan.gola@gmail.com', 'shanti gola', NULL, 'London, UK', '9582222957', NULL, 'shaan.gola@gmail.com'),
(19, 101, 'New project 011', 'Test project', 'New York, NY, USA', 'shanti gola', NULL, '9582222957', 'shaan.gola@gmail.com', 'shanti gola', NULL, 'London, UK', '9582222957', NULL, 'shaan.gola@gmail.com'),
(20, 102, NULL, NULL, '386 2nd Avenue, NY, New York, USA', 'shanti gola', NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'FL, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(21, 103, NULL, NULL, '386 2nd Avenue, NY, New York, USA', 'shanti gola', NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'FL, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(22, 104, NULL, NULL, '386 2nd Avenue, NY, New York, USA', 'shanti gola', NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'FL, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(23, 105, NULL, NULL, '386 2nd Avenue, NY, New York, USA', 'shanti gola', NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'FL, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(24, 106, NULL, NULL, '386 2nd Avenue, NY, New York, USA', 'shanti gola', NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'FL, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(25, 107, NULL, NULL, '386 2nd Avenue, NY, New York, USA', 'shanti gola', NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'FL, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(26, 108, NULL, NULL, '386 2nd Avenue, NY, New York, USA', 'shanti gola', NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'FL, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(27, 109, NULL, NULL, '386 2nd Avenue, NY, New York, USA', 'shanti gola', NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'FL, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(28, 110, NULL, NULL, '386 2nd Avenue, NY, New York, USA', 'shanti gola', NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'FL, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(29, 111, NULL, NULL, '386 2nd Avenue, NY, New York, USA', 'shanti gola', NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'FL, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(30, 112, NULL, NULL, '386 2nd Avenue, NY, New York, USA', 'shanti gola', NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'FL, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(31, 113, NULL, NULL, '386 2nd Avenue, NY, New York, USA', 'shanti gola', NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'FL, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(32, 114, NULL, NULL, '386 2nd Avenue, NY, New York, USA', 'shanti gola', NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'FL, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(33, 115, NULL, NULL, '386 2nd Avenue, NY, New York, USA', 'shanti gola', NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'FL, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(34, 116, NULL, NULL, '386 2nd Avenue, NY, New York, USA', 'shanti gola', NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'FL, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(35, 117, NULL, NULL, '386 2nd Avenue, NY, New York, USA', 'shanti gola', NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'FL, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(36, 118, NULL, NULL, '386 2nd Avenue, NY, New York, USA', 'shanti gola', NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'FL, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(37, 119, NULL, NULL, '386 2nd Avenue, NY, New York, USA', 'shanti gola', NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'FL, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(38, 120, NULL, NULL, '386 2nd Avenue, NY, New York, USA', 'shanti gola', NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'FL, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(39, 121, NULL, NULL, '386 2nd Avenue, NY, New York, USA', 'shanti gola', NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'FL, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(40, 122, NULL, NULL, '386 2nd Avenue, NY, New York, USA', 'shanti gola', NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'FL, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(41, 123, NULL, NULL, '386 2nd Avenue, NY, New York, USA', 'shanti gola', NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'FL, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(42, 124, NULL, NULL, '386 2nd Avenue, NY, New York, USA', 'shanti gola', NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'FL, USA', '9582222957', NULL, 'shaan.gola@gmail.com'),
(43, 125, NULL, NULL, 'TX, USA', NULL, NULL, '9582222957', 'shaan.gola@gmail.com', NULL, NULL, 'Gujarat, India', '9582222957', NULL, 'prospus.shantiprakash@gmail.com'),
(44, 126, NULL, NULL, 'TX, USA', NULL, NULL, '9582222957', 'shaan.gola@gmail.com', NULL, NULL, 'Gujarat, India', '9582222957', NULL, 'prospus.shantiprakash@gmail.com'),
(45, 127, NULL, NULL, 'TX, USA', NULL, NULL, '9582222957', 'shaan.gola@gmail.com', NULL, NULL, 'Gujarat, India', '9582222957', NULL, 'prospus.shantiprakash@gmail.com'),
(46, 128, NULL, NULL, 'TX, USA', NULL, NULL, '9582222957', 'shaan.gola@gmail.com', NULL, NULL, 'Gujarat, India', '9582222957', NULL, 'prospus.shantiprakash@gmail.com'),
(47, 29, NULL, NULL, 'NY, USA', NULL, NULL, '9582222957', 'shaan.gola@gmail.com', NULL, NULL, 'Telangana, India', '9582222957', NULL, 'shaan.gola@gmail.com'),
(48, 30, NULL, NULL, 'NY, USA', NULL, NULL, '9582222957', 'shaan.gola@gmail.com', NULL, NULL, 'Telangana, India', '9582222957', NULL, 'shaan.gola@gmail.com'),
(49, 31, 'gfgd', 'dfgfd', 'DFG Noodles, North Interstate 35 Frontage Road, Austin, TX, USA', NULL, NULL, NULL, 'adg@tmail.com', NULL, NULL, 'FDDF Malerbetrieb Frank Damien, Adalbertsteinweg, Aachen, Germany', NULL, NULL, 'agdhd@gmail.com'),
(50, 32, 'gfgd', 'dfgfd', 'DFG Noodles, North Interstate 35 Frontage Road, Austin, TX, USA', NULL, NULL, NULL, 'adg@tmail.com', 'fhgc', NULL, 'FDDF Malerbetrieb Frank Damien, Adalbertsteinweg, Aachen, Germany', NULL, NULL, 'agdhd@gmail.com'),
(51, 33, 'sadas', 'dsad', 'United Arab Emirates University - Abu Dhabi - United Arab Emirates', NULL, NULL, NULL, 'dsada@gmail.com', NULL, NULL, 'Delhi, India', NULL, NULL, 'g@gmail.com'),
(52, 34, NULL, 'weqw', 'York House Hotel, York Place, Edinburgh, UK', 'ewq', 'ewq', NULL, 'a@gmail.com', NULL, NULL, 'Edinburgh, UK', NULL, NULL, 'g@gmail.com'),
(53, 35, NULL, NULL, 'NY, USA', NULL, NULL, NULL, 'shaan.gola@gmail.com', NULL, NULL, 'USAA Bank Services Building, McDermott Freeway, San Antonio, TX, USA', NULL, NULL, 'shaan.gola@gmail.com'),
(54, 36, 'sdfsdf', 'erwer', 'Amsterdam, Netherlands', 'dsfsd', 'fdfdafaf', '1234567890', 'd@gmail.com', 'fdsf', 'fdsf', 'QC, Canada', NULL, NULL, 'sdsa@gmail.com'),
(55, 37, 'wewq', NULL, 'São Paulo, State of São Paulo, Brazil', NULL, NULL, NULL, 'w@gmail.com', NULL, NULL, '3390 Park Avenue, Bronx, NY, USA', NULL, NULL, 'a@gmail.com'),
(56, 38, 'ewqe', NULL, 'Edinburgh, UK', NULL, NULL, NULL, 'e@gmail.com', 'ewqe', NULL, 'Edinburgh, UK', NULL, NULL, 'a@gmail.com'),
(57, 39, NULL, NULL, 'England, UK', NULL, NULL, '9582222957', 'prospus.shantigola@gmail.com', NULL, NULL, 'New Delhi, Delhi, India', '9582222957', NULL, 'prospus.shantiprakash@gmail.com'),
(58, 40, NULL, NULL, 'England, UK', NULL, NULL, '9582222957', 'prospus.shantigola@gmail.com', NULL, NULL, 'New Delhi, Delhi, India', '9582222957', NULL, 'prospus.shantiprakash@gmail.com'),
(59, 41, NULL, NULL, 'HG- 8, Jay Prakash Narayan Marg, Kailash Nagar, Majura Gate, Surat, Gujarat, India', NULL, NULL, NULL, 'adg@tmail.com', NULL, NULL, 'Hyderabad, Telangana, India', NULL, NULL, 'cbvv@gmail.com'),
(60, 42, NULL, NULL, 'Bengaluru, Karnataka, India', NULL, NULL, NULL, 'bhanu.bhowmik@prospus.com', NULL, NULL, 'Bengaluru, Karnataka, India', NULL, NULL, 'bhanu.bhowmik@prospus.com');

-- --------------------------------------------------------

--
-- Table structure for table `heating_load_profiles`
--

CREATE TABLE `heating_load_profiles` (
  `heating_load_profiles_id` int(11) NOT NULL,
  `unique_row_id` int(11) NOT NULL,
  `profile_name` varchar(255) DEFAULT NULL,
  `profile_type` varchar(255) DEFAULT NULL,
  `max_heat_load_power` int(11) DEFAULT NULL,
  `max_heat_load_temp` int(11) DEFAULT NULL,
  `base_load_power` int(11) DEFAULT NULL,
  `base_load_temp` int(11) DEFAULT NULL,
  `zero_load_power` int(11) DEFAULT NULL,
  `zero_load_temp` int(11) DEFAULT NULL,
  `hp_investment_cost` int(11) DEFAULT NULL,
  `hp_discount` int(11) DEFAULT NULL,
  `maintenance_cost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `heating_load_profiles`
--

INSERT INTO `heating_load_profiles` (`heating_load_profiles_id`, `unique_row_id`, `profile_name`, `profile_type`, `max_heat_load_power`, `max_heat_load_temp`, `base_load_power`, `base_load_temp`, `zero_load_power`, `zero_load_temp`, `hp_investment_cost`, `hp_discount`, `maintenance_cost`) VALUES
(1, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 73, 'office south', 'Office Space', 33, NULL, 33, 33, 33, NULL, 3, 3, 34),
(5, 74, 'office south', 'Office Space', 33, NULL, 33, 33, 33, NULL, 3, 3, 34),
(6, 75, 'office south', 'Office Space', 33, NULL, 33, 33, 33, NULL, 3, 3, 34),
(7, 76, 'office south', 'Office Space', 33, NULL, 33, 33, 33, NULL, 3, 3, 34),
(8, 77, 'office south', 'Office Space', 33, NULL, 33, 33, 33, NULL, 3, 3, 34),
(9, 78, 'office south', 'Office Space', 33, NULL, 33, 33, 33, NULL, 3, 3, 34),
(10, 78, 'office south', 'Office Space', 33, NULL, 33, 33, 33, NULL, 3, 3, 34),
(11, 100, 'soufth office', 'Office Space', 22, NULL, 22, 22, 22, NULL, 33, 33, 33),
(12, 100, 'soufth office', 'Office Space', 22, NULL, 22, 22, 22, NULL, 33, 33, 33),
(13, 101, 'soufth office', 'Office Space', 22, NULL, 22, 22, 22, NULL, 33, 33, 33),
(14, 101, 'soufth office', 'Office Space', 22, NULL, 22, 22, 22, NULL, 33, 33, 33),
(15, 31, NULL, 'Office Space', 554, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 31, 'cvb', 'Hot Water Demand', 55454, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 31, NULL, 'Office Space', 554, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 31, 'cvb', 'Hot Water Demand', 55454, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 32, NULL, 'Office Space', 554, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 32, 'cvb', 'Hot Water Demand', 55454, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 32, NULL, 'Office Space', 554, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 32, 'cvb', 'Hot Water Demand', 55454, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `heat_sources`
--

CREATE TABLE `heat_sources` (
  `heat_sources_id` int(11) NOT NULL,
  `unique_row_id` int(11) NOT NULL,
  `heat_name` varchar(255) DEFAULT NULL,
  `heat_type` varchar(55) DEFAULT NULL,
  `drive_temp` int(11) DEFAULT NULL,
  `heat_capacity` int(11) DEFAULT NULL,
  `electricity_capacity` int(11) DEFAULT NULL,
  `thermal_efficienty` int(11) DEFAULT NULL,
  `electricity_efficienty` int(11) DEFAULT NULL,
  `new_installation` varchar(55) DEFAULT NULL,
  `heat_investment_cost` int(11) DEFAULT NULL,
  `heat_investment_discount` varchar(255) DEFAULT NULL,
  `heat_maintenance_cost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `heat_sources`
--

INSERT INTO `heat_sources` (`heat_sources_id`, `unique_row_id`, `heat_name`, `heat_type`, `drive_temp`, `heat_capacity`, `electricity_capacity`, `thermal_efficienty`, `electricity_efficienty`, `new_installation`, `heat_investment_cost`, `heat_investment_discount`, `heat_maintenance_cost`) VALUES
(1, 32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 78, 'chp in het', 'Process heat', 33, 3324, 3, 333, 33, 'No', 23, '2323', 3),
(6, 100, 'chp in basement', 'Process heat', 34, 343, 233, 33, 33, 'option1', 3, '3', 3),
(7, 101, 'chp in basement', 'Process heat', 34, 343, 233, 33, 33, 'option1', 3, '3', 3),
(8, 31, NULL, 'District heat', 45, 45, NULL, NULL, NULL, 'No', NULL, NULL, NULL),
(9, 32, NULL, 'District heat', 45, 45, NULL, NULL, NULL, 'No', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `machine_volume_flows`
--

CREATE TABLE `machine_volume_flows` (
  `machine_volume_flows_id` int(11) NOT NULL,
  `mod_types_id` int(11) NOT NULL,
  `vf_ht` int(11) NOT NULL,
  `vf_mt` int(11) NOT NULL,
  `vf_lt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `machine_volume_flows`
--

INSERT INTO `machine_volume_flows` (`machine_volume_flows_id`, `mod_types_id`, `vf_ht`, `vf_mt`, `vf_lt`) VALUES
(1, 1, 2500, 5100, 2900),
(2, 2, 3750, 7650, 4350),
(3, 3, 1600, 4100, 2000),
(4, 4, 2400, 6150, 3000);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_08_22_085751_update_user', 2),
(4, '2018_08_24_073541_create_permission_tables', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `mod_types`
--

CREATE TABLE `mod_types` (
  `mod_types_id` int(11) NOT NULL,
  `mod_type` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mod_types`
--

INSERT INTO `mod_types` (`mod_types_id`, `mod_type`) VALUES
(1, 'sika'),
(2, 'sikax'),
(3, 'sikaeco'),
(4, 'sikaxeco');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `option_id` int(11) NOT NULL,
  `unique_row_id` int(11) NOT NULL,
  `bus_system` int(11) DEFAULT NULL,
  `free_recooling` varchar(55) DEFAULT NULL,
  `pressure_drop` int(11) DEFAULT NULL,
  `profile_amb_tem` int(11) DEFAULT NULL,
  `option_language` varchar(50) DEFAULT NULL,
  `profile_bafa` varchar(55) DEFAULT NULL,
  `profile_calculation_method` varchar(255) DEFAULT NULL,
  `profile_controller` int(11) DEFAULT NULL,
  `profile_conventional_heat` int(11) DEFAULT NULL,
  `profile_cooling_load` varchar(55) DEFAULT NULL,
  `profile_heat_source` varchar(55) DEFAULT NULL,
  `profile_heat_supply` varchar(55) DEFAULT NULL,
  `profile_heating_load` varchar(55) DEFAULT NULL,
  `profile_recooling` varchar(55) DEFAULT NULL,
  `profile_recooling_temp` int(11) DEFAULT NULL,
  `recooling` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`option_id`, `unique_row_id`, `bus_system`, `free_recooling`, `pressure_drop`, `profile_amb_tem`, `option_language`, `profile_bafa`, `profile_calculation_method`, `profile_controller`, `profile_conventional_heat`, `profile_cooling_load`, `profile_heat_source`, `profile_heat_supply`, `profile_heating_load`, `profile_recooling`, `profile_recooling_temp`, `recooling`) VALUES
(1, 95, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 97, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 99, NULL, 'No', NULL, 1, '', 'calculate', 'Chilled water inlet temperature constant', NULL, NULL, 'Capacity [kW]', 'Utilize also for heating load profile', 'Priority for heating load profile', 'Capacity [kW]', 'Dry', NULL, NULL),
(4, 100, 22, 'No', 222, 1, '', 'calculate', 'Chilled water inlet temperature constant', 22, 22, 'Capacity [kW]', 'Utilize also for heating load profile', 'Priority for heating load profile', 'Capacity [kW]', 'Dry', NULL, NULL),
(5, 101, 22, 'No', 222, 1, '', 'calculate', 'Chilled water inlet temperature constant', 22, 22, 'Capacity [kW]', 'Utilize also for heating load profile', 'Priority for heating load profile', 'Capacity [kW]', 'Dry', NULL, NULL),
(6, 102, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 103, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 104, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 105, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 106, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 107, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 108, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 109, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 110, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 111, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 112, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 113, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 114, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 115, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 116, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 117, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 118, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 119, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 120, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 121, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 122, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 123, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 124, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 125, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 126, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 127, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 128, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 29, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 30, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 31, NULL, 'No', NULL, 1, '', 'Do not calculate', 'Chilled water inlet temperature constant', NULL, NULL, 'Capacity [kW]', 'Utilize also for heating load profile', 'Priority for heating load profile', 'Capacity [kW]', 'With spray tool', NULL, NULL),
(36, 32, NULL, 'No', NULL, 1, '', 'Do not calculate', 'Chilled water inlet temperature constant', NULL, NULL, 'Capacity [kW]', 'Utilize also for heating load profile', 'Priority for heating load profile', 'Capacity [kW]', 'With spray tool', NULL, NULL),
(37, 33, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(38, 34, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(39, 35, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(40, 36, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(42, 41, NULL, 'No', NULL, 1, NULL, 'calculate', 'Chilled water inlet temperature constant', NULL, NULL, 'Capacity [kW]', 'Utilize also for heating load profile', 'Priority for heating load profile', 'Capacity [kW]', 'Dry', NULL, NULL),
(43, 42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('prospus.shantigola@gmail.com', '$2y$10$s2E6K8QjOZMbYQzRwTTi4e1VvVry6mOvjqPeQE77cLHWP2fv7sX46', '2018-08-29 05:50:09');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `recooling_products`
--

CREATE TABLE `recooling_products` (
  `recooling_products_id` int(11) NOT NULL,
  `recooling_component_type` varchar(255) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `qth_nomst` float(11,2) NOT NULL COMMENT 'unit in KW',
  `dt_nomst` float(11,2) NOT NULL COMMENT 'unit in K',
  `qth_nomrk` float(11,2) NOT NULL COMMENT 'unit in KW	',
  `dt_nomrk` float(11,2) NOT NULL COMMENT 'unit in K',
  `qel_nomrk` float(11,2) NOT NULL,
  `qel_nomst` float(11,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recooling_products`
--

INSERT INTO `recooling_products` (`recooling_products_id`, `recooling_component_type`, `product_name`, `qth_nomst`, `dt_nomst`, `qth_nomrk`, `dt_nomrk`, `qel_nomrk`, `qel_nomst`) VALUES
(1, 're_cooler', 'eRec 10 | 29', 0.00, 0.00, 29.00, 2.30, 0.54, 0.00),
(2, 're_cooler', 'eRec 10 | 40', 0.00, 0.00, 40.00, 2.00, 0.72, 0.00),
(3, 're_cooler', 'eRec 20 | 58', 0.00, 0.00, 58.00, 2.30, 1.08, 0.00),
(4, 're_cooler', 'eRec 20 | 80', 0.00, 0.00, 80.00, 2.00, 1.00, 0.00),
(5, 're_cooler', 'eRec 30 | 87', 0.00, 0.00, 87.00, 2.40, 2.40, 0.00),
(6, 're_cooler', 'eRec 30 | 120', 0.00, 0.00, 120.00, 2.00, 3.06, 0.00),
(7, 're_cooler', 'eRec 40 | 116', 0.00, 0.00, 116.00, 2.40, 3.24, 0.00),
(8, 're_cooler', 'eRec 40 | 160', 0.00, 0.00, 160.00, 2.00, 3.20, 0.00),
(9, 're_cooler', 'eRec 50 | 145', 0.00, 0.00, 145.00, 2.30, 4.08, 0.00),
(10, 're_cooler', 'eRec 50 | 200', 0.00, 0.00, 200.00, 2.00, 5.50, 0.00),
(11, 're_cooler', 'eRec 60 | 170 | VB', 0.00, 0.00, 170.00, 3.40, 4.20, 0.00),
(12, 're_cooler', 'eRec 60 | 174', 0.00, 0.00, 174.00, 2.10, 4.90, 0.00),
(13, 're_cooler', 'eRec 60 | 240', 0.00, 0.00, 240.00, 2.00, 6.36, 0.00),
(14, 're_cooler', 'eRec 70 | 203', 0.00, 0.00, 203.00, 2.20, 5.10, 0.00),
(15, 're_cooler', 'eRec 70 | 280', 0.00, 0.00, 280.00, 2.00, 7.98, 0.00),
(16, 're_cooler', 'eRec 80 | 232', 0.00, 0.00, 232.00, 2.40, 6.36, 0.00),
(17, 're_cooler', 'eRec 80 | 320', 0.00, 0.00, 320.00, 2.00, 9.12, 0.00),
(18, 're_cooler', 'eRis 10 | 29', 0.00, 0.00, 29.00, 3.90, 0.41, 0.00),
(19, 're_cooler', 'eRis 10 | 40', 0.00, 0.00, 40.00, 3.50, 0.56, 0.00),
(20, 're_cooler', 'eRis 20 | 58', 0.00, 0.00, 58.00, 3.50, 0.90, 0.00),
(21, 're_cooler', 'eRis 20 | 80', 0.00, 0.00, 80.00, 3.50, 1.12, 0.00),
(22, 're_cooler', 'eRis 30 | 87', 0.00, 0.00, 87.00, 3.70, 2.36, 0.00),
(23, 're_cooler', 'eRis 30 | 120', 0.00, 0.00, 120.00, 3.50, 2.08, 0.00),
(24, 're_cooler', 'eRis 40 | 116', 0.00, 0.00, 116.00, 3.90, 2.04, 0.00),
(25, 're_cooler', 'eRis 40 | 160', 0.00, 0.00, 160.00, 3.50, 3.12, 0.00),
(26, 're_cooler', 'eRis 50 | 145', 0.00, 0.00, 145.00, 3.80, 3.66, 0.00),
(27, 're_cooler', 'eRis 50 | 200', 0.00, 0.00, 200.00, 3.50, 4.32, 0.00),
(28, 're_cooler', 'eRis 60 | 174', 0.00, 0.00, 174.00, 3.50, 4.40, 0.00),
(29, 're_cooler', 'eRis 60 | 240', 0.00, 0.00, 240.00, 3.50, 4.16, 0.00),
(30, 're_cooler', 'eRis 70 | 203', 0.00, 0.00, 203.00, 3.50, 4.56, 0.00),
(31, 're_cooler', 'eRis 70 | 280', 0.00, 0.00, 280.00, 3.50, 6.60, 0.00),
(32, 're_cooler', 'eRis 80 | 232', 0.00, 0.00, 232.00, 3.50, 5.70, 0.00),
(33, 're_cooler', 'eRis 80 | 320', 0.00, 0.00, 320.00, 3.50, 6.96, 0.00),
(34, 'circuit_separation', 'ST10', 39.23, 2.00, 0.00, 0.00, 0.00, 0.31),
(35, 'circuit_separation', 'ST10X', 59.73, 2.00, 0.00, 0.00, 0.00, 0.39),
(36, 'circuit_separation', 'ST20', 80.22, 2.00, 0.00, 0.00, 0.00, 0.47),
(37, 'circuit_separation', 'ST30', 111.60, 2.00, 0.00, 0.00, 0.00, 0.80),
(38, 'circuit_separation', 'ST20X', 111.60, 2.00, 0.00, 0.00, 0.00, 0.90),
(39, 'circuit_separation', 'ST40', 158.80, 2.00, 0.00, 0.00, 0.00, 1.55),
(40, 'circuit_separation', 'ST30X', 203.50, 2.00, 0.00, 0.00, 0.00, 1.41),
(41, 'circuit_separation', 'ST20+ST30', 191.82, 2.00, 0.00, 0.00, 0.00, 1.27),
(42, 'circuit_separation', 'ST40X', 282.80, 2.00, 0.00, 0.00, 0.00, 1.92),
(43, 'circuit_separation', 'ST30+ST40', 270.40, 2.00, 0.00, 0.00, 0.00, 2.35);

-- --------------------------------------------------------

--
-- Table structure for table `recooling_systems`
--

CREATE TABLE `recooling_systems` (
  `recooling_id` int(11) NOT NULL,
  `fahrenheit_id` int(11) NOT NULL,
  `recooler_component` varchar(11) NOT NULL,
  `recooler_method` varchar(11) NOT NULL,
  `recooler_product` varchar(55) NOT NULL,
  `recooler_units` int(11) NOT NULL,
  `recooler_name` varchar(55) DEFAULT NULL,
  `recooler_capacity` int(11) NOT NULL,
  `recooler_temp_diff` int(11) NOT NULL,
  `recooler_sec_volume` int(11) NOT NULL,
  `recooler_elec_consumption` int(11) NOT NULL,
  `recooler_available` varchar(11) NOT NULL,
  `recooler_inv_cost` int(11) DEFAULT NULL,
  `recooler_discount` int(11) DEFAULT NULL,
  `recooler_maint_cost` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `recooling_systems`
--

INSERT INTO `recooling_systems` (`recooling_id`, `fahrenheit_id`, `recooler_component`, `recooler_method`, `recooler_product`, `recooler_units`, `recooler_name`, `recooler_capacity`, `recooler_temp_diff`, `recooler_sec_volume`, `recooler_elec_consumption`, `recooler_available`, `recooler_inv_cost`, `recooler_discount`, `recooler_maint_cost`) VALUES
(1, 4, 'Re-cooler', 'Dry', 'eRec 20 | 58', 3, NULL, 3, 3, 3, 3, 'No', NULL, NULL, NULL),
(2, 5, 'Re-cooler', 'Dry', 'eRec 20 | 58', 3, NULL, 3, 3, 3, 3, 'No', NULL, NULL, NULL),
(3, 6, 'Re-cooler', 'Dry', 'eRec 20 | 58', 3, '33', 33, 33, 33, 333, 'No', 3, 3, 3),
(4, 7, 'Re-cooler', 'Dry', 'eRec 20 | 58', 3, '33', 33, 33, 33, 333, 'No', 3, 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phoneno` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type_id` int(11) NOT NULL DEFAULT '2',
  `status` int(11) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `new_user` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `company`, `phoneno`, `email`, `password`, `user_type_id`, `status`, `remember_token`, `created_at`, `updated_at`, `new_user`) VALUES
(1, 'shanti gola', 'abc company', '9582222957', 'prospus.shantigola@gmail.com', '$2y$10$FecgrgtxVSZ3Neqb/mZuQeCjkaC1PsSpFaByKC.pD71c5QcPtxZqS', 1, 1, 'BMF0u5UyUdYDZ67VvaRUYcUDEfz1dXKBfi399Ot37wyue82jN2zDIXZHUVml', '2018-08-21 13:59:54', '2018-08-29 12:27:02', 0),
(2, 'arti', 'abc company', '99999', 'prospus.artisharma@gmail.com', '$2y$10$.nmoc4n6RPHbzC72BPwVtuDsP4ZO.cZPojF8smXgED9vfvpYV.dby', 2, 1, '6II0JjrmDvHJMvvOZGyV2zRtk1TqKINInFgIZ5Zk9ix4kF8M70rUsg9K4hFz', '2018-08-21 13:59:54', '2018-09-05 09:37:12', 0),
(8, 'Fahrenheit admin', 'Fahrenheit', '999999999', 'fahrenheit_admin@gmail.com', '$2y$10$pC2yYVG.xj3hluz4MaqxLeCaEjlO4aCRvxtjOvPq.eA/kmNwHvgj2', 1, 1, 'nWe9GS6mgU8UyVc3nsL6OnQox5C2Lwo0fF4u5rWv7cYGmgBXc01494mhGx5F', '2018-08-28 00:10:00', '2018-09-05 12:59:01', 0),
(9, 'shanti gola', 'Prospus Testing', '9582222957', 'shaan.gola2@gmail.com', '$2y$10$9IEJz.tfIf9DbikBxkUK0eP5m5oBnrkjayOZp3OnfTt42suaH8c/G', 1, 0, NULL, '2018-08-28 00:24:38', '2018-08-28 01:42:34', 0),
(10, 'shanti gola', 'Prospus Testing', '9582222957', 'shaan.gola3@gmail.com', '$2y$10$dn8PS/83lUK4A.vj2vN3Oe66dYvxI9tk05XxuJ3zjM3HAqssxKqYO', 1, 0, NULL, '2018-08-28 00:24:38', '2018-09-06 04:26:34', 0),
(11, 'shanti gola', 'Prospus Testing', '9582222957', 'shaan.gola4@gmail.com', '$2y$10$L8Ion09sIN.JVGFovsdIFeRkGhYuGGEMUuNgpaDso1yFrskXDuY.C', 1, 1, 'mcltFCW5kjaQAG9ujnbRKWdC37wXsfOuH0iriODGnJAQdm7fipDM0AtM6OBe', '2018-08-28 00:24:38', '2018-10-11 12:45:03', 1),
(12, 'shanti gola', 'Prospus Testing', '9582222957', 'shaan.gola5@gmail.com', '$2y$10$n/wwK5icmHE3NH9GwJ1pmO7i4ybnCe.sHs3FX8KPghPtLB99RzE4S', 1, 0, NULL, '2018-08-28 00:24:38', '2018-09-06 04:27:03', 0),
(13, 'shanti gola', 'Prospus Testing', '9582222957', 'shaan.gola6@gmail.com', '$2y$10$w7M5BHaEyWmID6FhHbf/BObM9vmyGdLefCOUQW46DJFVfvx46akei', 1, 0, NULL, '2018-08-28 00:24:38', '2018-09-06 04:27:18', 0),
(14, 'Fahrenheit user', 'Fahrenheit', '9898989898', 'fahrenheit_user@gmail.com', '$2y$10$2y69bPWfQxZqSVfyU7AODOJnWx8dcoEEnMfDt0VpmV.qAMRIZhKMa', 2, 1, 'DJDZS0Rs9ACvvx3ztCfOQRJYhgeQayvPVBOLHoiZh6BY5W4OIvE6JxE4rM2z', '2018-09-05 13:21:59', '2018-09-05 13:21:59', 0),
(15, 'Fahrenheit expert', 'Fahrenheit', '999999999', 'fahrenheit_expert@gmail.com', '$2y$10$jk0A7XX.o0/EeF2/DrV62uYn1NWLfjJPBZfeO.vGEO.NgDl9hjHlW', 3, 1, 'TypXsqQcmvX5hRKJF7xXsUVs4Pfg8Z1MEu9QM8euz8OT2cI0kjPFkdCf4RD3', '2018-09-05 13:26:06', '2018-09-05 13:26:06', 0),
(16, 'new user', 'fahrenheit', '0000000000', 'agdhd@gmail.com', '$2y$10$SwxIVsaEQVGNj9SY6NBi4OP..9Myz2HDFOc0VQ.6R3rxE5Y5.Gv12', 2, 1, NULL, '2018-11-28 13:43:15', '2018-11-28 13:43:15', 0),
(17, 'new user', 'fahrenheit', '0000000000', 'g@gmail.com', '$2y$10$XaIjD0pjbPc8hWbW.E9bq.M3kmBZqRw1x.TNbuG/mNbo8eQildi7a', 2, 1, NULL, '2018-11-29 13:27:39', '2018-11-29 13:27:39', 0),
(18, 'new user', 'fahrenheit', '0000000000', 'shaan.gola@gmail.com', '$2y$10$jNckt/XhGoSjpQoN7gEps.SwCAkiogmwiK7BGa.l9T3NIzHiSLqNG', 2, 1, NULL, '2018-11-30 10:50:42', '2018-11-30 10:50:42', 0),
(19, 'new user', 'fahrenheit', '9582222957', 'prospus.shantiprakash@gmail.com', '$2y$10$UH1ZqCpHxGQ7O6wfrnIB3OhrJM.rxXJvuRAApTD6vBZ8j5Fzi3HD6', 2, 1, NULL, '2018-12-03 11:28:00', '2018-12-03 11:28:00', 0),
(20, 'new user', 'fahrenheit', '0000000000', 'cbvv@gmail.com', '$2y$10$ZdHB4IfklB8hztdjT8D7/OjjToeyWEIHOpFYKBFfDSPYTCyjygpFy', 2, 1, NULL, '2019-01-24 07:06:14', '2019-01-24 07:06:14', 0),
(21, 'new user', 'fahrenheit', '0000000000', 'bhanu.bhowmik@prospus.com', '$2y$10$vIUNCsFS0KXPdcHD9evya.hRArN2qbKJftA7jfDr3.3YCKgHcbvkK', 2, 1, NULL, '2019-01-24 07:08:18', '2019-01-24 07:08:18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_reports`
--

CREATE TABLE `user_reports` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=>enable,1=>disable',
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_reports`
--

INSERT INTO `user_reports` (`id`, `user_id`, `title`, `status`, `timestamp`) VALUES
(2, 2, 'AD_Cal_01234', 0, '2018-08-24 10:06:54'),
(3, 2, 'AD_Cal_01234', 0, '2018-08-24 10:06:54'),
(7, 8, 'AD_Cal_01234', 0, '2018-08-24 10:06:54'),
(9, 14, 'AD_Cal_01234', 0, '2018-08-24 10:06:54'),
(10, 15, 'AD_Cal_01234', 0, '2018-08-24 10:06:54'),
(12, 8, 'AD_Cal_01234', 0, '2018-08-24 10:06:54'),
(13, 8, 'AD_Cal_01234', 0, '2018-08-24 10:06:54'),
(14, 8, 'AD_Cal_01234', 0, '2018-08-24 10:06:54'),
(15, 8, 'AD_Cal_01234', 0, '2018-08-24 10:06:54'),
(16, 8, 'AD_Cal_01234', 0, '2018-08-24 10:06:54'),
(17, 8, 'AD_Cal_01234', 0, '2018-08-24 10:06:54'),
(18, 8, 'AD_Cal_01234', 0, '2018-08-24 10:06:54'),
(19, 8, 'AD_Cal_01234', 0, '2018-08-24 10:06:54'),
(20, 8, 'AD_Cal_01234', 0, '2018-08-24 10:06:54'),
(21, 8, 'AD_Cal_01234', 0, '2018-08-24 10:06:54'),
(22, 8, 'AD_Cal_01234', 0, '2018-08-24 10:06:54'),
(23, 14, 'AD_Cal_01234', 0, '2018-08-24 10:06:54'),
(24, 14, 'AD_Cal_01234', 0, '2018-08-24 10:06:54'),
(25, 14, 'AD_Cal_01234', 0, '2018-08-24 10:06:54'),
(26, 14, 'AD_Cal_01234', 0, '2018-08-24 10:06:54'),
(27, 14, 'AD_Cal_01234', 0, '2018-08-24 10:06:54'),
(28, 14, 'AD_Cal_01234', 0, '2018-08-24 10:06:54'),
(29, 8, 'ADCALC_652', 0, '2018-11-28 11:04:37'),
(30, 8, 'ADCALC_577', 0, '2018-11-28 11:07:00'),
(31, 16, 'DFGFD_GFGD', 0, '2018-11-28 13:43:15'),
(32, 8, 'DFGFD_GFGD', 0, '2018-11-28 13:51:40'),
(33, 17, 'DSAD_SADAS', 0, '2018-11-29 13:27:39'),
(34, 17, 'WEQW_781', 0, '2018-11-29 14:07:54'),
(35, 18, 'ADCALC_546', 0, '2018-11-30 10:50:42'),
(36, 1, 'ERWER_SDFSDF', 0, '2018-11-30 15:42:15'),
(37, 8, 'ADCALC_WEWQ', 0, '2018-12-03 11:25:58'),
(38, 8, 'ADCALC_EWQE', 0, '2018-12-03 11:27:53'),
(39, 19, 'ADCALC_953', 0, '2018-12-03 11:28:00'),
(40, 19, 'ADCALC_656', 0, '2018-12-03 11:33:03'),
(41, 20, 'ADCALC_834', 0, '2019-01-24 07:06:14'),
(42, 21, 'ADCALC_844', 0, '2019-01-24 07:08:18');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` int(11) NOT NULL,
  `title` varchar(55) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `title`, `status`) VALUES
(1, 'admin', 1),
(2, 'user', 1),
(3, 'expert', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adka_calculations`
--
ALTER TABLE `adka_calculations`
  ADD PRIMARY KEY (`adka_calculations_id`);

--
-- Indexes for table `calculations`
--
ALTER TABLE `calculations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `lt` (`lt`),
  ADD KEY `ht` (`ht`),
  ADD KEY `a` (`a`),
  ADD KEY `b` (`b`);

--
-- Indexes for table `cal_constants`
--
ALTER TABLE `cal_constants`
  ADD PRIMARY KEY (`cal_constants_id`);

--
-- Indexes for table `compression_chillers`
--
ALTER TABLE `compression_chillers`
  ADD PRIMARY KEY (`compression_chillers_id`);

--
-- Indexes for table `cooling_load_profiles`
--
ALTER TABLE `cooling_load_profiles`
  ADD PRIMARY KEY (`cooling_load_profiles_id`);

--
-- Indexes for table `economic_datas`
--
ALTER TABLE `economic_datas`
  ADD PRIMARY KEY (`economic_datas_id`);

--
-- Indexes for table `economic_data_additional_infos`
--
ALTER TABLE `economic_data_additional_infos`
  ADD PRIMARY KEY (`economic_data_additional_infos_id`),
  ADD KEY `economic_data_additional_infos_id` (`economic_data_additional_infos_id`),
  ADD KEY `economic_data_id` (`economic_data_id`);

--
-- Indexes for table `fahrenheits`
--
ALTER TABLE `fahrenheits`
  ADD PRIMARY KEY (`fahrenheit_id`);

--
-- Indexes for table `general_informations`
--
ALTER TABLE `general_informations`
  ADD PRIMARY KEY (`general_informations_id`),
  ADD KEY `unique_row_id` (`unique_row_id`);

--
-- Indexes for table `heating_load_profiles`
--
ALTER TABLE `heating_load_profiles`
  ADD PRIMARY KEY (`heating_load_profiles_id`),
  ADD KEY `unique_row_id` (`unique_row_id`),
  ADD KEY `heating_load_profiles_id` (`heating_load_profiles_id`);

--
-- Indexes for table `heat_sources`
--
ALTER TABLE `heat_sources`
  ADD PRIMARY KEY (`heat_sources_id`),
  ADD KEY `heat_sources_id` (`heat_sources_id`),
  ADD KEY `unique_row_id` (`unique_row_id`);

--
-- Indexes for table `machine_volume_flows`
--
ALTER TABLE `machine_volume_flows`
  ADD PRIMARY KEY (`machine_volume_flows_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `mod_types`
--
ALTER TABLE `mod_types`
  ADD PRIMARY KEY (`mod_types_id`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `option_id` (`option_id`),
  ADD KEY `unique_row_id` (`unique_row_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recooling_products`
--
ALTER TABLE `recooling_products`
  ADD PRIMARY KEY (`recooling_products_id`);

--
-- Indexes for table `recooling_systems`
--
ALTER TABLE `recooling_systems`
  ADD PRIMARY KEY (`recooling_id`),
  ADD KEY `fahrenheit_id` (`fahrenheit_id`),
  ADD KEY `recooling_id` (`recooling_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_reports`
--
ALTER TABLE `user_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adka_calculations`
--
ALTER TABLE `adka_calculations`
  MODIFY `adka_calculations_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `calculations`
--
ALTER TABLE `calculations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `cal_constants`
--
ALTER TABLE `cal_constants`
  MODIFY `cal_constants_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `compression_chillers`
--
ALTER TABLE `compression_chillers`
  MODIFY `compression_chillers_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `cooling_load_profiles`
--
ALTER TABLE `cooling_load_profiles`
  MODIFY `cooling_load_profiles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `economic_datas`
--
ALTER TABLE `economic_datas`
  MODIFY `economic_datas_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;
--
-- AUTO_INCREMENT for table `economic_data_additional_infos`
--
ALTER TABLE `economic_data_additional_infos`
  MODIFY `economic_data_additional_infos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=101;
--
-- AUTO_INCREMENT for table `fahrenheits`
--
ALTER TABLE `fahrenheits`
  MODIFY `fahrenheit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `general_informations`
--
ALTER TABLE `general_informations`
  MODIFY `general_informations_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `heating_load_profiles`
--
ALTER TABLE `heating_load_profiles`
  MODIFY `heating_load_profiles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `heat_sources`
--
ALTER TABLE `heat_sources`
  MODIFY `heat_sources_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `machine_volume_flows`
--
ALTER TABLE `machine_volume_flows`
  MODIFY `machine_volume_flows_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `mod_types`
--
ALTER TABLE `mod_types`
  MODIFY `mod_types_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `recooling_products`
--
ALTER TABLE `recooling_products`
  MODIFY `recooling_products_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `recooling_systems`
--
ALTER TABLE `recooling_systems`
  MODIFY `recooling_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `user_reports`
--
ALTER TABLE `user_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `recooling_systems`
--
ALTER TABLE `recooling_systems`
  ADD CONSTRAINT `recooling_systems_ibfk_1` FOREIGN KEY (`fahrenheit_id`) REFERENCES `fahrenheits` (`fahrenheit_id`);

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
