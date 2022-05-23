# Elimar DB
DROP DATABASE itma2;

# Creacion de la base de datos
CREATE DATABASE `itma2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci;

# Usar base de datos
USE itma2;

#-----------------------Catalogos-----------------------

# Creacion del catalogo de sexo
CREATE TABLE `itma2`.`t_cat_sexo`(
	`id_cat_sexo` INT NOT NULL AUTO_INCREMENT,
    `sexo` VARCHAR(10) NOT NULL,
    PRIMARY KEY (`id_cat_sexo`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci;

# Creacion del catalogo de estado civil
CREATE TABLE `itma2`.`t_cat_estado_civil`(
	`id_cat_estado_civil` INT NOT NULL AUTO_INCREMENT,
	`estado_civil` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id_cat_estado_civil`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci;

# Creacion de catalogo de escolaridad
CREATE TABLE `itma2`.`t_cat_escolaridad` (
	`id_cat_escolaridad` INT NOT NULL AUTO_INCREMENT,
	`escolaridad` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id_cat_escolaridad`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci;

# Creacion de catalogo datos direccion
CREATE TABLE `itma2`.`t_cat_data_dir` (
	`id_cat_data_dir` INT NOT NULL AUTO_INCREMENT,
	`codigo_postal` VARCHAR(255) NOT NULL,
	`colonia` VARCHAR(255) NOT NULL,
	`alcaldia` VARCHAR(255) NOT NULL,
    `estado` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id_cat_data_dir`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci;

# Creacion de catalogo de roles
CREATE TABLE `itma2`.`t_cat_rol` (
	`id_cat_rol` INT NOT NULL AUTO_INCREMENT,
	`rol` VARCHAR(10) NOT NULL,
	`descripcion_rol` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id_cat_rol`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci;

# Creacion de catalogo carrera
CREATE TABLE `itma2`.`t_cat_carrera` (
	`id_cat_carrera` INT NOT NULL AUTO_INCREMENT,
	`carrera` VARCHAR(4) NOT NULL,
	`nombre_carrera` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id_cat_carrera`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci;

#Creacion de catalogo plan de estudio
CREATE TABLE `itma2`.`t_cat_plan_estudio` (
	`id_cat_plan_estudio` INT NOT NULL AUTO_INCREMENT,
    `id_cat_carrera` INT NOT NULL,
	`plan_estudio` VARCHAR(13) NOT NULL,
	PRIMARY KEY (`id_cat_plan_estudio`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci;

# Creacion de catalogo especialidad
CREATE TABLE `itma2`.`t_cat_especialidad` (
	`id_cat_especialidad` INT NOT NULL AUTO_INCREMENT,
	`id_cat_carrera` INT NOT NULL,
	`especialidad` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id_cat_especialidad`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci;

# Creacion de catalogo genero
CREATE TABLE `itma2`.`t_cat_genero` (
	`id_cat_genero` INT NOT NULL AUTO_INCREMENT,
	`genero` VARCHAR(255) NOT NULL,
	PRIMARY KEY (`id_cat_genero`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci;

# Creacion de catalogo de estatus del alumno
CREATE TABLE `itma2`.`t_cat_estatus` (
	`id_cat_estatus` INT NOT NULL AUTO_INCREMENT,
	`estatus` VARCHAR(10) NOT NULL,
	`descripcion_estatus` VARCHAR(255) NOT NULL,
PRIMARY KEY (`id_cat_estatus`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci;

# Creacion de catalogo de tipo de ingreso del alumno
CREATE TABLE `itma2`.`t_cat_tipo_ingreso` (
	`id_cat_tipo_ingreso` INT NOT NULL AUTO_INCREMENT,
	`tipo_ingreso` VARCHAR(255) NOT NULL,
PRIMARY KEY (`id_cat_tipo_ingreso`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci;

# Cracion de catalogo de materias
CREATE TABLE `t_cat_materias` (
  `id_cat_materia` INT NOT NULL auto_increment,
  `id_cat_carrera` INT NOT NULL,
  `clave` varchar(225) NOT NULL,
  `nombre` varchar(255) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  `creditos_teorica` varchar(225) NOT NULL,
  `creditos_practica` varchar(225) NOT NULL,
  `creditos_totales` varchar(225) NOT NULL,
  `semestre` int(11) NOT NULL,
  `exclusivo_carrera` INT(11) NOT NULL,
  PRIMARY KEY (`id_cat_materia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

# Cracion de catalogo de aulas
CREATE TABLE `t_cat_aulas` (
  `id_cat_aulas` INT NOT NULL auto_increment,
  `aula` varchar(255) NOT NULL,
  `capacidad` INT NOT NULL,
  `ubicacion` VARCHAR(255) NOT NULL,
  `estatus_aula` VARCHAR(255) NOT NULL,
  `observaciones` VARCHAR(255),
  PRIMARY KEY (`id_cat_aulas`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

#-----------------------Tablas-----------------------

# Creacion de tabla persona
CREATE TABLE `itma2`.`t_persona` (
	`id_persona` INT NOT NULL AUTO_INCREMENT,
	`id_cat_sexo` INT NOT NULL,
	`id_cat_estado_civil` INT NOT NULL,
	`id_cat_escolaridad` INT NOT NULL,
	`fk_direccion` INT NOT NULL,
	`nombre_persona` VARCHAR(255) NOT NULL,
	`apellido_paterno` VARCHAR(255) NOT NULL,
	`apellido_materno` VARCHAR(255) NOT NULL,
	`curp` VARCHAR(255) NOT NULL,
	`telefono` VARCHAR(10) NOT NULL,
	`correo` VARCHAR(255) NOT NULL,
	`fecha_nacimiento` DATE NOT NULL,
  `nacionalidad` VARCHAR(255) NOT NULL DEFAULT 'Mexicana',
	`insert_datos` DATETIME NOT NULL DEFAULT NOW(),
	PRIMARY KEY (`id_persona`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci;

# Creacion de tabla trabajador
CREATE TABLE `itma2`.`t_trabajador` (
	`id_trabajador` INT NOT NULL AUTO_INCREMENT,
	`fk_persona` INT NOT NULL,
	`id_cat_rol` INT NOT NULL,
	`rfc` VARCHAR(13) NOT NULL,
	`insert_datos` DATETIME NOT NULL DEFAULT NOW(),
	PRIMARY KEY (`id_trabajador`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci;

# Creacion de tabla usuario
CREATE TABLE `itma2`.`t_usuario` (
	`id_usuario` INT NOT NULL AUTO_INCREMENT,
	`fk_persona` INT NOT NULL,
	`id_cat_rol` INT NOT NULL,
	`estado` INT NOT NULL,
	`correo_usuario` VARCHAR(255) NOT NULL,
	`password` VARCHAR(255) NOT NULL,
	`insert_datos` DATETIME NOT NULL DEFAULT NOW(),
	PRIMARY KEY (`id_usuario`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci;

# Creacion de tabla alumnos
CREATE TABLE `itma2`.`t_alumno` (
	`id_alumno` INT NOT NULL AUTO_INCREMENT,
	`fk_numero_control` INT NOT NULL,
	`fk_persona` INT NOT NULL,
	`id_cat_especialidad` INT NOT NULL,
	`id_cat_estatus` INT NOT NULL,
	`id_cat_carrera` INT NOT NULL,
    `id_cat_plan_estudio` INT NOT NULL,
    `id_cat_tipo_ingreso` INT NOT NULL,
    `lugar_nacimiento` VARCHAR(255) NOT NULL,
	`semestre` INT NOT NULL,
    `periodo_ingreso` VARCHAR(5) NOT NULL,
    `periodos_revalidados` INT NOT NULL,
	PRIMARY KEY (`id_alumno`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci;

# Creacion de tabla numero de control
CREATE TABLE `itma2`.`t_numero_control` (
	`id_numero_control` INT NOT NULL AUTO_INCREMENT,
    `periodo` VARCHAR(5) NOT NULL,
	`numero_control` VARCHAR(10) NOT NULL,
	`autorizar` VARCHAR(255) NOT NULL,
	`estatus` VARCHAR(255) NOT NULL,
	`fecha_autorizacion` DATETIME NOT NULL DEFAULT NOW(),
	PRIMARY KEY (`id_numero_control`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci;

# Creacion de tabla direccion
CREATE TABLE `itma2`.`t_direccion` (
	`id_direccion` INT NOT NULL AUTO_INCREMENT,
    `codigo_postal` INT NOT NULL,
	`estado` VARCHAR(255) NOT NULL,
	`alcaldia` VARCHAR(255) NOT NULL,
	`colonia` VARCHAR(255) NOT NULL,
	`calle` VARCHAR(255) NOT NULL,
	`numero_interior` VARCHAR(15) NOT NULL DEFAULT 'S/N',
	`numero_exterior` VARCHAR(15) NOT NULL DEFAULT 'S/N',
	PRIMARY KEY (`id_direccion`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci;

# Creacion de tabla bitacora alumno
CREATE TABLE `itma2`.`t_bitacora_alumno` (
	`id_bitacora_alumno` INT NOT NULL AUTO_INCREMENT,
	`periodo` INT NOT NULL,
	`numero_control` VARCHAR(13) NOT NULL,
	`usuario_modifico` VARCHAR(45) NOT NULL,
	`lugar_accion` VARCHAR(45) NOT NULL,
	`operacion` TEXT NOT NULL,
    `fecha_hora_modifico` DATETIME NOT NULL DEFAULT NOW(),
  PRIMARY KEY (`id_bitacora_alumno`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci;

# Creacion de tabla notificaciones
CREATE TABLE `itma2`.`t_notificaciones` (
	`id_notificacion` INT NOT NULL AUTO_INCREMENT,
	`descripcion` TEXT NOT NULL,
	`usuario_envio` VARCHAR(45) NOT NULL,
	`usuario_recibe` VARCHAR(45) NOT NULL,
	`estado` INT NOT NULL DEFAULT '1',
  `noti_emergente` INT NOT NULL DEFAULT 0, 
	`fecha_notificacion` DATETIME NOT NULL DEFAULT now(),
	PRIMARY KEY (`id_notificacion`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci;

# Creacion de tabla solicitud
CREATE TABLE `itma2` . `t_solicitud` (	
	`id_solicitud` INT NOT NULL AUTO_INCREMENT,
    `solicitud` VARCHAR(255) NOT NULL,
    `descripcion_solicitud` TEXT NOT NULL,
    `id_usuario_envio_solicitud` INT NOT NULL,
    `id_usuario_recibio_solicitud` INT NOT NULL,
    `estado_solicitud` INT NOT NULL DEFAULT 0,
	`estado_mensaje_emergente` INT NOT NULL DEFAULT 0,
    `fecha_realizo_solicitud` DATETIME NOT NULL DEFAULT now(),
    `fecha_atencion_solicitud` DATETIME,
    PRIMARY KEY (`id_solicitud`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci;

#Creacion de tabla semestre

CREATE TABLE `itma2` . `t_semestre` (
	`id_semestre` INT NOT NULL AUTO_INCREMENT,
    `descripcion_semestre` VARCHAR(255) NOT NULL,
    `f_inicio` DATE,
    `f_final` DATE,
    `semestre` VARCHAR(255) NOT NULL,
    `estado` INt NOT NULL DEFAULT 0,
    PRIMARY KEY (`id_semestre`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci;

#Creacion de tabla horario

CREATE TABLE `itma2` . `t_horario` (
	  `id_horario` INT NOT NULL AUTO_INCREMENT,
    `id_cat_materia` INT NOT NULL,
    `fk_usuario` INT NOT NULL,
    `lunes` VARCHAR(20) NOT NULL,
    `martes` VARCHAR(20) NOT NULL,
    `miercoles` VARCHAR(20) NOT NULL,
    `jueves` VARCHAR(20) NOT NULL,
    `viernes` VARCHAR(20) NOT NULL,
    `sabado` VARCHAR(20) NOT NULL,
    `capacidad` INT NOT NULL,
    PRIMARY KEY (`id_horario`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci;

CREATE TABLE `itma2` . `t_grupo` (
    `id_grupo` INT NOT NULL AUTO_INCREMENT,
    `id_cat_materia` INT NOT NULL,
    `id_cat_aulas` INT NOT NULL,
    `nombre_grupo` VARCHAR(255) NOT NULL,
    `hora_inicio` VARCHAR(255) NOT NULL,
    `hora_final` VARCHAR(255) NOT NULL,
    PRIMARY KEY (`id_grupo`)
)ENGINE = InnoDB DEFAULT CHARACTER SET = utf8mb4 COLLATE = utf8mb4_spanish2_ci;

#-----------------------Llaves Foraneas-----------------------

#FK de t_persona
ALTER TABLE `itma2`.`t_persona` 
ADD INDEX `sexo a persona_idx` (`id_cat_sexo` ASC),
ADD INDEX `estado civil  a persona_idx` (`id_cat_estado_civil` ASC),
ADD INDEX `escolaridad a persona_idx` (`id_cat_escolaridad` ASC),
ADD INDEX `direccion a persona_idx` (`fk_direccion` ASC);
;
ALTER TABLE `itma2`.`t_persona` 
ADD CONSTRAINT `sexo a persona`
  FOREIGN KEY (`id_cat_sexo`)
  REFERENCES `itma2`.`t_cat_sexo` (`id_cat_sexo`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `estado civil  a persona`
  FOREIGN KEY (`id_cat_estado_civil`)
  REFERENCES `itma2`.`t_cat_estado_civil` (`id_cat_estado_civil`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `escolaridad a persona`
  FOREIGN KEY (`id_cat_escolaridad`)
  REFERENCES `itma2`.`t_cat_escolaridad` (`id_cat_escolaridad`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `direccion a persona`
  FOREIGN KEY (`fk_direccion`)
  REFERENCES `itma2`.`t_direccion` (`id_direccion`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


  
# FK t_alumno
ALTER TABLE `itma2`.`t_alumno` 
ADD INDEX `numero control a alumno_idx` (`fk_numero_control` ASC),
ADD INDEX `persona a alumno_idx` (`fk_persona` ASC),
ADD INDEX `especialidad a alumno_idx` (`id_cat_especialidad` ASC),
ADD INDEX `estatus a alumno_idx` (`id_cat_estatus` ASC),
ADD INDEX `carrera a alumno_idx` (`id_cat_carrera` ASC),
ADD INDEX `plan estudio a alumno_idx` (`id_cat_plan_estudio` ASC);
;
ALTER TABLE `itma2`.`t_alumno` 
ADD CONSTRAINT `numero control a alumno`
  FOREIGN KEY (`fk_numero_control`)
  REFERENCES `itma2`.`t_numero_control` (`id_numero_control`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `persona a alumno`
  FOREIGN KEY (`fk_persona`)
  REFERENCES `itma2`.`t_persona` (`id_persona`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `especialidad a alumno`
  FOREIGN KEY (`id_cat_especialidad`)
  REFERENCES `itma2`.`t_cat_especialidad` (`id_cat_especialidad`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `estatus a alumno`
  FOREIGN KEY (`id_cat_estatus`)
  REFERENCES `itma2`.`t_cat_estatus` (`id_cat_estatus`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `carrera a alumno`
  FOREIGN KEY (`id_cat_carrera`)
  REFERENCES `itma2`.`t_cat_carrera` (`id_cat_carrera`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `plan estudio a alumno`
  FOREIGN KEY (`id_cat_plan_estudio`)
  REFERENCES `itma2`.`t_cat_plan_estudio` (`id_cat_plan_estudio`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
ALTER TABLE `itma2`.`t_alumno` 
ADD INDEX `tipo ingreso a alumno_idx` (`id_cat_tipo_ingreso` ASC);
;
ALTER TABLE `itma2`.`t_alumno` 
ADD CONSTRAINT `tipo ingreso a alumno`
  FOREIGN KEY (`id_cat_tipo_ingreso`)
  REFERENCES `itma2`.`t_cat_tipo_ingreso` (`id_cat_tipo_ingreso`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
# FK t_trabajadores
ALTER TABLE `itma2`.`t_trabajador` 
ADD INDEX `persona a trabajadores_idx` (`fk_persona` ASC),
ADD INDEX `rol a trabajadores_idx` (`id_cat_rol` ASC);
;
ALTER TABLE `itma2`.`t_trabajador` 
ADD CONSTRAINT `persona a trabajadores`
  FOREIGN KEY (`fk_persona`)
  REFERENCES `itma2`.`t_persona` (`id_persona`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `rol a trabajadores`
  FOREIGN KEY (`id_cat_rol`)
  REFERENCES `itma2`.`t_cat_rol` (`id_cat_rol`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
# FK t_usuario
ALTER TABLE `itma2`.`t_usuario` 
ADD INDEX `personas a usuario_idx` (`fk_persona` ASC),
ADD INDEX `rol a usuario_idx` (`id_cat_rol` ASC);
;
ALTER TABLE `itma2`.`t_usuario` 
ADD CONSTRAINT `personas a usuario`
  FOREIGN KEY (`fk_persona`)
  REFERENCES `itma2`.`t_persona` (`id_persona`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `rol a usuario`
  FOREIGN KEY (`id_cat_rol`)
  REFERENCES `itma2`.`t_cat_rol` (`id_cat_rol`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
# FK t_cat_especialidad
ALTER TABLE `itma2`.`t_cat_especialidad` 
ADD INDEX `especialidad a carrera_idx` (`id_cat_carrera` ASC);
;
ALTER TABLE `itma2`.`t_cat_especialidad` 
ADD CONSTRAINT `especialidad a carrera`
  FOREIGN KEY (`id_cat_carrera`)
  REFERENCES `itma2`.`t_cat_carrera` (`id_cat_carrera`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
#FK t_cat_plan_estudio
ALTER TABLE `itma2`.`t_cat_plan_estudio` 
ADD INDEX `plan de estudio a carrera_idx` (`id_cat_carrera` ASC);
;
ALTER TABLE `itma2`.`t_cat_plan_estudio` 
ADD CONSTRAINT `plan_estudio a carrera`
  FOREIGN KEY (`id_cat_carrera`)
  REFERENCES `itma2`.`t_cat_carrera` (`id_cat_carrera`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
#FK t_cat_materias
ALTER TABLE `itma2`.`t_cat_materias` 
ADD INDEX `materias a carrera_idx` (`id_cat_carrera` ASC);
;
ALTER TABLE `itma2`.`t_cat_materias` 
ADD CONSTRAINT `materia a carrera`
  FOREIGN KEY (`id_cat_carrera`)
  REFERENCES `itma2`.`t_cat_carrera` (`id_cat_carrera`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;  


# FK t_horario
ALTER TABLE `itma2`.`t_horario` 
ADD INDEX `materia a horario_idx` (`id_cat_materia` ASC),
ADD INDEX `usuario a horario_idx` (`fk_usuario` ASC)
;
ALTER TABLE `itma2`.`t_horario` 
ADD CONSTRAINT `materia a horario`
  FOREIGN KEY (`id_cat_materia`)
  REFERENCES `itma2`.`t_cat_materias` (`id_cat_materia`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `usuario a horario`
  FOREIGN KEY (`fk_usuario`)
  REFERENCES `itma2`.`t_usuario` (`id_usuario`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;


# FK t_grupo
ALTER TABLE `itma2`.`t_grupo`
ADD INDEX `materia a grupo_idx` (`id_cat_materia` ASC),
ADD INDEX `aulas a grupo_idx` (`id_cat_aulas` ASC)
;
ALTER TABLE `itma2`.`t_grupo` 
ADD CONSTRAINT `materia a grupo`
  FOREIGN KEY (`id_cat_materia`)
  REFERENCES `itma2`.`t_cat_materias` (`id_cat_materia`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
ADD CONSTRAINT `aulas a grupo`
  FOREIGN KEY (`id_cat_aulas`)
  REFERENCES `itma2`.`t_cat_aulas` (`id_cat_aulas`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION;
  
  