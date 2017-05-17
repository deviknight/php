-- --------------------------------------------------------

--
-- Table structure for table `chungloai`
--

CREATE TABLE IF NOT EXISTS `category` (
  `CateID` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `Description` varchar(500) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`CateID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `chungloai`
--

INSERT INTO `category` (`CateID`, `CategoryName`) VALUES
(1, 'Điện Thoại'),
(2, 'Máy Tính Bảng'),
(3, 'LapTop'),
(4, 'Phụ Kiện');

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `Product` (
  `ProductID` int(11) NOT NULL AUTO_INCREMENT,
  `ProductName` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,  
  `CateID` int(11) NOT NULL,
  `Quantity` int(11) DEFAULT NULL,
  `Price` Double DEFAULT NULL,
  `Description` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,  
  `Picture` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,    
  PRIMARY KEY (`ProductID`),
  FOREIGN KEY (CateID) REFERENCES category(CateID)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=12 ;


--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `OrderProduct` (
  `OrderID` int(11) NOT NULL AUTO_INCREMENT,
  `OrderDate` DATETIME  DEFAULT NULL,  
  `ShipDate` DATETIME  DEFAULT NULL,  
  `ShipName` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,    
  `ShipAddress` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,    
  PRIMARY KEY (`OrderID`)  
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=12 ;


--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `OrderDetail` (
  `OrderID` int(11) NOT NULL,
  `ProductID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=12 ;

--
-- Alter table orderDetail
--

ALTER TABLE OrderDetail ADD FOREIGN KEY (ProductID) REFERENCES Product(ProductID);
ALTER TABLE OrderDetail ADD FOREIGN KEY (OrderID) REFERENCES OrderProduct(OrderID);




