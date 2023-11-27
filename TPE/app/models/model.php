<?php

require_once './config.php';

class Model {
    protected $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=' .MYSQL_HOST .';dbname=' .MYSQL_DB .';charset=utf8', MYSQL_USER, MYSQL_PASS);
        $this->deploy();
    }

    public function deploy() {
        $query = $this->db->query('SHOW TABLES');
        $tables = $query->fetchAll();
        if(count($tables)==0) {
            $sql = <<<END
            -- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `canciones` int(11) NOT NULL,
  `duracion` int(11) NOT NULL,
  `artista` varchar(45) NOT NULL,
  `genero` varchar(45) NOT NULL,
  `lanzamiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `nombre`, `canciones`, `duracion`, `artista`, `genero`, `lanzamiento`) VALUES
(1, 'Álbum Ejemplo', 12, 45, 'Artista Ejemplo', 'Pop', '2023-01-01'),
(2, 'Otro Álbum', 10, 38, 'Otro Artista', 'Rock', '2023-02-15'),
(3, 'Álbum Increíble', 15, 50, 'Artista Increíble', 'Electrónica', '2023-03-20'),
(4, 'ERROR', 14, 48, 'The Warning', 'Rock', '2022-11-26'),
(5, 'The Wall', 26, 81, 'Pink Floyd', 'Rock', '1979-06-29');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`) VALUES
(1, 'webadmin', '$2y$10$HPPHxvPCbxUSDYVbIRKJPuBpgrE1UC7z9JKwZZubHrgv/ChlK2eie');

-- --------------------------------------------------------

--
-- Table structure for table `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `id_album` int(45) NOT NULL,
  `nombre_album` varchar(45) NOT NULL,
  `via` varchar(45) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `precio` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ventas`
--

INSERT INTO `ventas` (`id`, `id_album`, `nombre_album`, `via`, `tipo`, `precio`) VALUES
(2, 5, 'Vinilo', 'Online', 'Venta en Tienda', 39.99),
(3, 1, 'Descarga digital', 'Online', 'Venta online', 15),
(4, 4, 'Casete', 'Tienda física', 'Venta directa', 12.99),
(6, 2, 'CD', 'Tienda Física', 'Venta Directa', 20.99),
(7, 4, 'Descarga Digital', 'Sitio Web', 'Venta Online', 15.5),
(25, 4, 'ERROR', 'Local', 'Vinilo', 19.99);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id` (`id_album`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `id_album_fk` FOREIGN KEY (`id_album`) REFERENCES `album` (`id`);
COMMIT;
END;
$this->db->query($sql);
        }
    }
}
?>