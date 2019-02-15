<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::library('AbstractDao');
Import::entidade('Usuario');

class UsuarioDao extends AbstractDao
{

    private $controllerUsuario;

    private function getController()
    {
        if ($this->controllerUsuario == null)
            $this->controllerUsuario = new ControllerUsuario();
        return $this->controllerUsuario;
    }

    private function montaUsuario($res)
    {
        return $this->getController()->montaUsuario($res["idUsuario"], $res["nome"], $res["cpf"], $res["rg"], $res["sexo"], $res["celular"], $res["dataNasc"], $res["email"], $res["idTitulacao"], $res["login"], $res["senha"], $res["idCargo"], $res["idIes"], $res["ativo"], $res["idAvatar"], $res["linkRecovery"], $res["dataRecovery"], $res["firstAccess"]);
    }

    public function findAllAvatares()
    {
        $this->sql = "SELECT * FROM avatar;";

        $this->prepare();

        return $this->fetchAll();
    }

    public function findAllAtivas()
    {
        $this->sql = "SELECT * FROM usuario WHERE ativo = TRUE ORDER BY nome;";

        $this->prepare();

        $usuarios = array();
        foreach ($this->fetchAll() as $res) {
            array_push($usuarios, $this->montaUsuario($res));
        }
        return $usuarios;
    }

    public function findByLoginAtivo($login)
    {
        $this->sql = "SELECT * FROM usuario WHERE ativo = TRUE AND login = ?;";

        $this->prepare();

        $this->setParam($login);

        $res = $this->singleResult();
        if ($res != null) {
            return $this->montaUsuario($res);
        }
        return null;
    }

    public function findByLoginAtivoDifferentId($login, $id)
    {
        $this->sql = "SELECT * FROM usuario WHERE ativo = TRUE AND login = ? AND \"idUsuario\" != ?;";

        $this->prepare();

        $this->setParam($login);
        $this->setParam($id);

        $res = $this->singleResult();
        if ($res != null) {
            return $this->montaUsuario($res);
        }
        return null;
    }

    public function findByLoginSenhaAtivo($login, $senha)
    {
        $this->sql = "SELECT * FROM usuario WHERE ativo = TRUE AND login = ? AND senha = ?;";

        $this->prepare();

        $this->setParam($login);
        $this->setParam($senha);

        $res = $this->singleResult();
        if ($res != null) {
            return $this->montaUsuario($res);
        }

        return null;
    }

    public function findByLoginEmailAtivo($login, $email)
    {
        $this->sql = "SELECT * FROM usuario WHERE ativo = TRUE AND login = ? AND email = ?;";

        $this->prepare();

        $this->setParam($login);
        $this->setParam($email);

        $res = $this->singleResult();
        if ($res != null) {
            return $this->montaUsuario($res);
        }

        return null;
    }

    public function findByIdAtivo($id)
    {
        $this->sql = "SELECT * FROM usuario WHERE ativo = TRUE AND \"idUsuario\" = ?;";

        $this->prepare();

        $this->setParam($id);

        $res = $this->singleResult();
        if ($res != null) {
            return $this->montaUsuario($res);
        }
        return null;
    }

    public function insert(Usuario $usuario)
    {
        $this->sql = "INSERT INTO usuario (nome, email, login, senha, sexo, cpf, rg, celular, \"dataNasc\", \"idCargo\", \"idTitulacao\", \"idIes\", ativo, \"idAvatar\", \"firstAccess\") VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, TRUE)";

        $this->prepare();

        $this->setParam($usuario->getNome());
        $this->setParam($usuario->getEmail());
        $this->setParam($usuario->getLogin());
        $this->setParam($usuario->getSenha());
        $this->setParam($usuario->getSexo());
        $this->setParam($usuario->getCpf());
        $this->setParam($usuario->getRg());
        $this->setParam($usuario->getCelular());
        $this->setParam($usuario->getDataNasc());
        $this->setParam($usuario->getIdCargo());
        $this->setParam($usuario->getIdTitulacao());
        $this->setParam($usuario->getIdIes());
        $this->setParam($usuario->isAtivo());
        $this->setParam($usuario->getIdAvatar());

        return $this->isPersist("usuario", "idUsuario");
    }

    public function update(Usuario $usuario)
    {
        $this->sql = "UPDATE usuario SET nome = ?, email = ?, sexo = ?, cpf = ?, rg = ?, celular = ?, \"dataNasc\" = ?, \"idTitulacao\" = ?, \"idIes\" = ?, ativo = ? WHERE \"idUsuario\" = ?;";

        $this->prepare();

        $this->setParam($usuario->getNome());
        $this->setParam($usuario->getEmail());
        $this->setParam($usuario->getSexo());
        $this->setParam($usuario->getCpf());
        $this->setParam($usuario->getRg());
        $this->setParam($usuario->getCelular());
        $this->setParam($usuario->getDataNasc());
        $this->setParam($usuario->getIdTitulacao());
        $this->setParam($usuario->getIdIes());
        $this->setParam($usuario->isAtivo());
        $this->setParam($usuario->getId());

        $this->execute();
    }

    public function updateAcessso(Usuario $usuario)
    {
        $this->sql = "UPDATE usuario SET senha = ?, \"idCargo\" = ? WHERE \"idUsuario\" = ?;";

        $this->prepare();

        $this->setParam($usuario->getSenha());
        $this->setParam($usuario->getIdCargo());
        $this->setParam($usuario->getId());
        $this->execute();
    }

    public function updateLoginById($idUser, $login)
    {
        $this->sql = "UPDATE usuario SET login = ? WHERE \"idUsuario\" = ?;";

        $this->prepare();

        $this->setParam($login);
        $this->setParam($idUser);

        $this->execute();
    }

    public function updateIdAvatarById($idUser, $idAvatar)
    {
        $this->sql = "UPDATE usuario SET \"idAvatar\" = ? WHERE \"idUsuario\" = ?;";

        $this->prepare();

        $this->setParam($idAvatar);
        $this->setParam($idUser);

        $this->execute();
    }

    public function updateFirstAccessById($idUser)
    {
        $this->sql = "UPDATE usuario SET \"firstAccess\" = FALSE WHERE \"idUsuario\" = ?;";

        $this->prepare();

        $this->setParam($idUser);

        $this->execute();
    }

    public function inative($id)
    {
        $this->sql = "UPDATE usuario SET ativo = ? WHERE \"idUsuario\" = ?;";

        $this->prepare();

        $this->setParam("FALSE");
        $this->setParam($id);

        $this->execute();
    }

    public function insertTokenRecoveryPass($id, $link)
    {
        $this->sql = "UPDATE usuario SET \"linkRecovery\" = ?, \"dataRecovery\" = CURRENT_TIMESTAMP WHERE \"idUsuario\" = ?;";

        $this->prepare();

        $this->setParam($link);
        $this->setParam($id);

        $this->execute();
    }

    public function selecByLinkAndAtivo($link)
    {
        $this->sql = "SELECT * FROM usuario WHERE \"linkRecovery\" = ? AND ativo = TRUE;";

        $this->prepare();

        $this->setParam($link);

        $res = $this->singleResult();
        if ($res != null) {
            return $this->montaUsuario($res);
        }
        return null;
    }

    public function updateSenhaByLinkRecoveryPass($link, $senha)
    {
        $this->sql = "UPDATE usuario SET senha = ? WHERE \"linkRecovery\" = ?;";

        $this->prepare();

        $this->setParam($senha);
        $this->setParam($link);

        $this->execute();
    }

    public function deleteTokenRecoveryPass($id)
    {
        $this->sql = "UPDATE usuario SET \"linkRecovery\" = ?, \"dataRecovery\" = ? WHERE \"idUsuario\" = ?;";

        $this->prepare();

        $this->setParam(null);
        $this->setParam(null);
        $this->setParam($id);

        $this->execute();
    }
}
