<?php
/**
 * Created by PhpStorm.
 * User: Pichau
 * Date: 06/08/2018
 * Time: 00:35
 */

require_once "DBConnection.php";
require_once "Horario_Funcionamento.php";

class Horario_FuncionamentoCrud
{
    private $conexao;

    public function __construct()
    {
        $this->conexao = DBConnection::getConexao();
    }

    public function getHorario($id)
    {
        //RETORNA UMA CATEGORIA, DADO UM ID

        //FAZER A CONSULTA
        $sql = 'select * from horario_funcionamento where id='.$id;
        $resultado = $this->conexao->query($sql);

        //FETCH - TRANSFORMA O RESULTADO EM UM ARRAY ASSOCIATIVO
        $horario = $resultado->fetch(PDO::FETCH_ASSOC);

        //CRIAR OBJETO DO TIPO CATEGORIA - USANDO OS VALORES DA CONSULTA
        $objetoHorario = new Horario_Funcionamento(
            $horario['seg'],
            $horario['seg1'],
            $horario['ter'],
            $horario['ter1'],
            $horario['qua'],
            $horario['qua1'],
            $horario['qui'],
            $horario['qui1'],
            $horario['sex'],
            $horario['sex1'],
            $horario['sab'],
            $horario['sab1'],
            $horario['dom'],
            $horario['dom1'],
            $horario['id_local'],
            $horario['id']);

        //RETORNAR UM OBJETO CATEGORIA COM OS VALORES
        return $objetoHorario;

    }


    public function getLocais()
    {
        $sql = "SELECT * FROM horario_funcionamento";

        $resultado = $this->conexao->query($sql);

        $horarios = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($horarios as $horario) {
            $seg = $horario['seg'];
            $seg1 = $horario['seg1'];
            $ter = $horario['ter'];
            $ter1 = $horario['ter1'];
            $qua = $horario['qua'];
            $qua1 = $horario['qua1'];
            $qui = $horario['qui'];
            $qui1 = $horario['qui1'];
            $sex = $horario['sex'];
            $sex1 = $horario['sex1'];
            $sab = $horario['sab'];
            $sab1 = $horario['sab1'];
            $dom = $horario['dom'];
            $dom1 = $horario['dom1'];
            $id_local = $horario['id_local'];
            $id = $horario['id'];

            $obj = new Horario_Funcionamento($seg,$seg1,$ter,$ter1,$qua,$qua1,$qui,$qui1,$sex,$sex1,$sab,$sab1,$dom,$dom1,$id_local,$id);
            $ListaHorario[] = $obj;
        }
        return $ListaHorario;
    }

    public function getLocaisLocal($id_local)
    {
        $sql = "SELECT * FROM horario_funcionamento WHERE id_local =".$id_local;

        $resultado = $this->conexao->query($sql);

        $horarios = $resultado->fetchAll(PDO::FETCH_ASSOC);

        foreach ($horarios as $horario) {
            $seg = $horario['seg'];
            $seg1 = $horario['seg1'];
            $ter = $horario['ter'];
            $ter1 = $horario['ter1'];
            $qua = $horario['qua'];
            $qua1 = $horario['qua1'];
            $qui = $horario['qui'];
            $qui1 = $horario['qui1'];
            $sex = $horario['sex'];
            $sex1 = $horario['sex1'];
            $sab = $horario['sab'];
            $sab1 = $horario['sab1'];
            $dom = $horario['dom'];
            $dom1 = $horario['dom1'];
            $id_local = $horario['id_local'];
            $id = $horario['id'];

            $obj = new Horario_Funcionamento($seg,$seg1,$ter,$ter1,$qua,$qua1,$qui,$qui1,$sex,$sex1,$sab,$sab1,$dom,$dom1,$id_local,$id);
            $ListaHorario[] = $obj;
        }
        return $ListaHorario;
    }

    public function insertHorario(Horario_Funcionamento $horario){
        $sql = "insert into horario_funcionamento (seg,seg1,ter,ter1,qua,qua1,qui,qui1,sex,sex1,sab,sab1,dom,dom1,id_local)
                values (
                '{$horario->getSeg()}',
                '{$horario->getSeg1()}',
                '{$horario->getTer()}',
                '{$horario->getTer1()}',
                '{$horario->getQua()}',
                '{$horario->getQua1()}',
                '{$horario->getQui()}',
                '{$horario->getQui1()}',
                '{$horario->getSex()}',
                '{$horario->getSex1()}',
                '{$horario->getSab()}',
                '{$horario->getSab1()}',
                '{$horario->getDom()}',
                '{$horario->getDom1()}',
                '{$horario->getIdLocal()}')";
        $sql = str_replace("''", "null", $sql);
        try {//TENTA EXECUTAR A INSTRUCAO
            $this->conexao->exec($sql);
        } catch (PDOException $e) {//EM CASO DE ERRO, CAPTURA A MENSAGEM
            return $e->getMessage();
        }
    }

}