<?php
class AdminExperienciasControlador
{
    private $db;

    public function __construct()
    {
        $this->db = BaseDatos::conectar();
    }

    // Listar todas las experiencias
    public function index()
    {
        $titulo = "Gestión de Experiencias";

        // Obtener filtros
        $region = $_GET['region'] ?? '';
        $estado = $_GET['estado'] ?? '';
        $busqueda = $_GET['busqueda'] ?? '';

        // Construir query
        $sql = "SELECT * FROM experiencias WHERE 1=1";
        $params = [];

        if ($region) {
            $sql .= " AND region = :region";
            $params[':region'] = $region;
        }

        if ($estado !== '') {
            $sql .= " AND disponible = :disponible";
            $params[':disponible'] = $estado;
        }

        if ($busqueda) {
            $sql .= " AND nombre LIKE :busqueda";
            $params[':busqueda'] = '%' . $busqueda . '%';
        }

        $sql .= " ORDER BY id DESC";

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);
        $experiencias = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once RUTA_VISTAS . 'admin/plantillas/encabezado.php';
        require_once RUTA_VISTAS . 'admin/plantillas/sidebar.php';
        require_once RUTA_VISTAS . 'admin/experiencias/index.php';
        require_once RUTA_VISTAS . 'admin/plantillas/pie.php';
    }

    // Mostrar formulario de crear
    public function crear()
    {
        $titulo = "Nueva Experiencia";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->guardar();
            return;
        }

        require_once RUTA_VISTAS . 'admin/plantillas/encabezado.php';
        require_once RUTA_VISTAS . 'admin/plantillas/sidebar.php';
        require_once RUTA_VISTAS . 'admin/experiencias/crear.php';
        require_once RUTA_VISTAS . 'admin/plantillas/pie.php';
    }

    // Guardar nueva experiencia
    private function guardar()
    {
        try {
            $nombre = $_POST['nombre'] ?? '';
            $region = $_POST['region'] ?? '';
            $descripcion_corta = $_POST['descripcion_corta'] ?? '';
            $descripcion_larga = $_POST['descripcion_larga'] ?? '';
            $precio = $_POST['precio'] ?? 0;
            $duracion = $_POST['duracion'] ?? '';
            $disponible = isset($_POST['disponible']) ? 1 : 0;

            // Manejar upload de imagen
            $imagen = 'publico/imagenes/experiencias/default.jpg';
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
                $imagen = $this->uploadImagen($_FILES['imagen']);
            }

            $sql = "INSERT INTO experiencias (nombre, region, descripcion_corta, descripcion_larga, precio, duracion, imagen, disponible) 
                    VALUES (:nombre, :region, :descripcion_corta, :descripcion_larga, :precio, :duracion, :imagen, :disponible)";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':nombre' => $nombre,
                ':region' => $region,
                ':descripcion_corta' => $descripcion_corta,
                ':descripcion_larga' => $descripcion_larga,
                ':precio' => $precio,
                ':duracion' => $duracion,
                ':imagen' => $imagen,
                ':disponible' => $disponible
            ]);

            $_SESSION['mensaje'] = 'Experiencia creada exitosamente';
            $_SESSION['tipo_mensaje'] = 'success';
            header('Location: admin.php?module=experiencias');
            exit;

        } catch (PDOException $e) {
            $_SESSION['mensaje'] = 'Error al crear experiencia: ' . $e->getMessage();
            $_SESSION['tipo_mensaje'] = 'error';
            header('Location: admin.php?module=experiencias&action=crear');
            exit;
        }
    }

    // Mostrar formulario de editar
    public function editar()
    {
        $id = $_GET['id'] ?? 0;
        $titulo = "Editar Experiencia";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->actualizar($id);
            return;
        }

        // Obtener experiencia
        $sql = "SELECT * FROM experiencias WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        $experiencia = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$experiencia) {
            $_SESSION['mensaje'] = 'Experiencia no encontrada';
            $_SESSION['tipo_mensaje'] = 'error';
            header('Location: admin.php?module=experiencias');
            exit;
        }

        require_once RUTA_VISTAS . 'admin/plantillas/encabezado.php';
        require_once RUTA_VISTAS . 'admin/plantillas/sidebar.php';
        require_once RUTA_VISTAS . 'admin/experiencias/editar.php';
        require_once RUTA_VISTAS . 'admin/plantillas/pie.php';
    }

    // Actualizar experiencia
    private function actualizar($id)
    {
        try {
            $nombre = $_POST['nombre'] ?? '';
            $region = $_POST['region'] ?? '';
            $descripcion_corta = $_POST['descripcion_corta'] ?? '';
            $descripcion_larga = $_POST['descripcion_larga'] ?? '';
            $precio = $_POST['precio'] ?? 0;
            $duracion = $_POST['duracion'] ?? '';
            $disponible = isset($_POST['disponible']) ? 1 : 0;

            // Obtener imagen actual
            $sql = "SELECT imagen FROM experiencias WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
            $experiencia = $stmt->fetch(PDO::FETCH_ASSOC);
            $imagen = $experiencia['imagen'];

            // Manejar upload de nueva imagen
            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
                $imagen = $this->uploadImagen($_FILES['imagen']);
            }

            $sql = "UPDATE experiencias 
                    SET nombre = :nombre, region = :region, descripcion_corta = :descripcion_corta, 
                        descripcion_larga = :descripcion_larga, precio = :precio, duracion = :duracion, 
                        imagen = :imagen, disponible = :disponible 
                    WHERE id = :id";

            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':nombre' => $nombre,
                ':region' => $region,
                ':descripcion_corta' => $descripcion_corta,
                ':descripcion_larga' => $descripcion_larga,
                ':precio' => $precio,
                ':duracion' => $duracion,
                ':imagen' => $imagen,
                ':disponible' => $disponible,
                ':id' => $id
            ]);

            $_SESSION['mensaje'] = 'Experiencia actualizada exitosamente';
            $_SESSION['tipo_mensaje'] = 'success';
            header('Location: admin.php?module=experiencias');
            exit;

        } catch (PDOException $e) {
            $_SESSION['mensaje'] = 'Error al actualizar experiencia: ' . $e->getMessage();
            $_SESSION['tipo_mensaje'] = 'error';
            header('Location: admin.php?module=experiencias&action=editar&id=' . $id);
            exit;
        }
    }

    // Eliminar experiencia
    public function eliminar()
    {
        $id = $_GET['id'] ?? 0;

        try {
            // Verificar si tiene reservas
            $sql = "SELECT COUNT(*) as total FROM reservas WHERE experiencia_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result['total'] > 0) {
                $_SESSION['mensaje'] = 'No se puede eliminar. Esta experiencia tiene reservas asociadas.';
                $_SESSION['tipo_mensaje'] = 'error';
            } else {
                $sql = "DELETE FROM experiencias WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->execute([':id' => $id]);

                $_SESSION['mensaje'] = 'Experiencia eliminada exitosamente';
                $_SESSION['tipo_mensaje'] = 'success';
            }

        } catch (PDOException $e) {
            $_SESSION['mensaje'] = 'Error al eliminar experiencia: ' . $e->getMessage();
            $_SESSION['tipo_mensaje'] = 'error';
        }

        header('Location: admin.php?module=experiencias');
        exit;
    }

    // Toggle disponibilidad
    public function toggle()
    {
        $id = $_GET['id'] ?? 0;

        try {
            $sql = "UPDATE experiencias SET disponible = NOT disponible WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);

            $_SESSION['mensaje'] = 'Estado actualizado exitosamente';
            $_SESSION['tipo_mensaje'] = 'success';

        } catch (PDOException $e) {
            $_SESSION['mensaje'] = 'Error al actualizar estado: ' . $e->getMessage();
            $_SESSION['tipo_mensaje'] = 'error';
        }

        header('Location: admin.php?module=experiencias');
        exit;
    }

    // Upload de imagen
    private function uploadImagen($file)
    {
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];
        $filename = $file['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            throw new Exception('Formato de imagen no permitido');
        }

        if ($file['size'] > 2 * 1024 * 1024) { // 2MB
            throw new Exception('La imagen es demasiado grande (máx 2MB)');
        }

        $newFilename = uniqid() . '.' . $ext;
        $destination = 'publico/imagenes/experiencias/' . $newFilename;

        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return $destination;
        } else {
            throw new Exception('Error al subir la imagen');
        }
    }
}
?>