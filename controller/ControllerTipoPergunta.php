<?php
if (file_exists('../library/Import.php'))
    include_once '../library/Import.php';
elseif (file_exists('../../library/Import.php'))
    include_once '../../library/Import.php';
else
    include_once 'library/Import.php';

Import::entidade('TipoResposta');
Import::controller('ControllerPergunta');
Import::dao('RespostaDao');

class ControllerTipoPergunta
{

    public function perguntas()
    {
        $cont = 1;
        $controller = new ControllerPergunta();
        foreach ($controller->getAllAtivos() as $pergunta) {
            if ($pergunta->getIdTipoResposta() == TipoResposta::PARAGRAFO) {
                echo "<div class='row col s12'>
					<div class='col s12'>
						<b>" . $cont . ". " . $pergunta->getDescricao() . "</b> ";
                echo ($pergunta->isObrigatoria()) ? "<i class='blue-text'>*</i>" : "";
                echo "</div>
					<div class='input-field col s12'>
						Resposta:
						<textarea id='resposta" . $cont . "' class='resposta' name='resposta" . $cont . "' ";
                echo ($pergunta->isObrigatoria()) ? "required" : "";
                echo "></textarea>
					</div>
				</div>";
            } elseif ($pergunta->getIdTipoResposta() == TipoResposta::SIM_NAO) {
                echo "<div class='row col s12'>
					<div class='col s12'>
						<b>" . $cont . ". " . $pergunta->getDescricao() . "</b> ";
                echo ($pergunta->isObrigatoria()) ? "<i class='blue-text'>*</i>" : "";
                echo "</div>
					<div class='col s12 center'>
						<input type='radio' name='resposta" . $cont . "' value='Sim' id='sim" . $cont . "' class='with-gap'/> <label
							for='sim" . $cont . "' class='black-text'>Sim</label> <input type='radio' name='resposta" . $cont . "'
							value='Não' id='nao" . $cont . "' class='with-gap' /> <label for='nao" . $cont . "' class='black-text'>Não</label>
					</div>
					<div class='input-field col s12 center'>
						<label for='obs" . $cont . "" . $cont . "'>Observação:</label>
						<textarea id='obs" . $cont . "" . $cont . "' name='obs" . $cont . "'></textarea>
					</div>
				</div>";
            } elseif ($pergunta->getIdTipoResposta() == TipoResposta::SIM_NAO_TALVEZ) {
                echo "<div class='row col s12'>
					<div class='col s12'>
						<b>" . $cont . ". " . $pergunta->getDescricao() . "</b> ";
                echo ($pergunta->isObrigatoria()) ? "<i class='blue-text'>*</i>" : "";
                echo "</div>
					<div class='col s12 center'>
						<input type='radio' name='resposta" . $cont . "' value='Sim' id='sim" . $cont . "' class='with-gap' /> <label
							for='sim" . $cont . "' class='black-text'>Sim</label> <input type='radio' name='resposta" . $cont . "'
							value='Não' id='nao" . $cont . "' class='with-gap' /> <label for='nao" . $cont . "' class='black-text'>Não</label>
                        <input type='radio' name='resposta" . $cont . "' value='Talvez' id='talvez" . $cont . "' class='with-gap' /> <label
							for='talvez" . $cont . "' class='black-text'>Talvez</label>
					</div>
					<div class='input-field col s12 center'>
						<label for='obs" . $cont . "'>Observação:</label>
						<textarea id='obs" . $cont . "' name='obs" . $cont . "'></textarea>
					</div>
				</div>";
            } elseif ($pergunta->getIdTipoResposta() == TipoResposta::EXCELENTE_BOM_REGULAR_PESSIMO) {
                echo "<div class='row col s12'>
					<div class='col s12'>
						<b>" . $cont . ". " . $pergunta->getDescricao() . "</b> ";
                echo ($pergunta->isObrigatoria()) ? "<i class='blue-text'>*</i>" : "";
                echo "</div>
					<div class='col s12 center'>
						<input type='radio' name='resposta" . $cont . "' value='Excelente' id='ex" . $cont . "' class='with-gap' /> <label
							for='ex" . $cont . "' class='black-text'>Excelente</label> <input type='radio' name='resposta" . $cont . "'
							value='Bom' id='bom" . $cont . "' class='with-gap' /> <label for='bom" . $cont . "' class='black-text'>Bom</label>
                        <input type='radio' name='resposta" . $cont . "' value='Regular' id='reg" . $cont . "' class='with-gap' /> <label
							for='reg" . $cont . "' class='black-text'>Regular</label>
                        <input type='radio' name='resposta" . $cont . "' value='Péssimo' id='pes" . $cont . "' class='with-gap' /> <label
							for='pes" . $cont . "' class='black-text'>Péssimo</label>
					</div>
					<div class='input-field col s12 center'>
						<label for='obs" . $cont . "'>Observação:</label>
						<textarea id='obs" . $cont . "' name='obs" . $cont . "'></textarea>
					</div>
				</div>";
            }
            $cont ++;
        }
    }

    public function editPerguntas($idRelatorio)
    {
        $cont = 1;
        $controller = new ControllerPergunta();
        $respostaRelatorio = new RespostaDao();
        foreach ($controller->getAllAtivos() as $pergunta) {
            foreach ($respostaRelatorio->findByIdRelatorio($idRelatorio) as $resposta) {
                $r = $respostaRelatorio->findById($resposta['idResposta']);
                if ($r['idPergunta'] == $pergunta->getId()) {
                    if ($pergunta->getIdTipoResposta() == TipoResposta::PARAGRAFO) {
                        echo "<div class='row col s12'>
        					<div class='col s12'>
        						<b>" . $cont . ". " . $pergunta->getDescricao() . "</b> ";
                        echo ($pergunta->isObrigatoria()) ? "<i class='blue-text'>*</i>" : "";
                        echo "</div>
        					<div class='input-field col s12'>
        						Resposta:
        						<textarea id='resposta" . $cont . "' class='resposta' name='resposta" . $cont . "' ";
                        echo ($pergunta->isObrigatoria()) ? "required" : "";
                        echo "></textarea>
                            </div>
        				</div>";
                    } elseif ($pergunta->getIdTipoResposta() == TipoResposta::SIM_NAO) {
                        echo "<div class='row col s12'>
        					<div class='col s12'>
        						<b>" . $cont . ". " . $pergunta->getDescricao() . "</b> ";
                        echo ($pergunta->isObrigatoria()) ? "<i class='blue-text'>*</i>" : "";
                        echo "</div>
        					<div class='col s12 center'>";
                        if ($r['resposta'] == "Sim")
                            echo "<input type='radio' checked name='resposta" . $cont . "' value='Sim' id='sim" . $cont . "' class='with-gap' /> <label
        							for='sim" . $cont . "' class='black-text'>Sim</label>";
                        else
                            echo "<input type='radio' name='resposta" . $cont . "' value='Sim' id='sim" . $cont . "' class='with-gap' /> <label
        							for='sim" . $cont . "' class='black-text'>Sim</label>";
                        if ($r['resposta'] == "Não")
                            echo "<input type='radio' name='resposta" . $cont . "'
        							value='Não' id='nao" . $cont . "' class='with-gap' /> <label for='nao" . $cont . "' class='black-text'>Não</label>";
                        else
                            echo "<input type='radio' checked name='resposta" . $cont . "'
        							value='Não' id='nao" . $cont . "' class='with-gap' /> <label for='nao" . $cont . "' class='black-text'>Não</label>";
                        echo "</div>
        					<div class='input-field col s12'>
        						<label for='obs" . $cont . "'>Observação:</label>
        						<textarea id='obs" . $cont . "' name='obs" . $cont . "'>" . $r['obs'] . "</textarea>
        					</div>
        				</div>";
                    } elseif ($pergunta->getIdTipoResposta() == TipoResposta::SIM_NAO_TALVEZ) {
                        echo "<div class='row col s12'>
        					<div class='col s12'>
        						<b>" . $cont . ". " . $pergunta->getDescricao() . "</b> ";
                        echo ($pergunta->isObrigatoria()) ? "<i class='blue-text'>*</i>" : "";
                        echo "</div>
        					<div class='col s12 center'>";
                        if ($r['resposta'] == "Sim")
                            echo "<input type='radio' checked name='resposta" . $cont . "' value='Sim' id='sim" . $cont . "' class='with-gap' /> <label
        							for='sim" . $cont . "' class='black-text'>Sim</label>";
                        else
                            echo "<input type='radio' name='resposta" . $cont . "' value='Sim' id='sim" . $cont . "' class='with-gap' /> <label
        							class='black-text' for='sim" . $cont . "'>Sim</label>";
                        if ($r['resposta'] == "Não")
                            echo "<input type='radio' name='resposta" . $cont . "'
        							value='Não' id='nao" . $cont . "' class='with-gap' /> <label for='nao" . $cont . "' class='black-text'>Não</label>";
                        else
                            echo "<input type='radio' checked name='resposta" . $cont . "'
        							value='Não' id='nao" . $cont . "' class='with-gap' /> <label for='nao" . $cont . "' class='black-text'>Não</label>";
                        if ($r['resposta'] == "Talvez")
                            echo "<input type='radio' checked name='resposta" . $cont . "' value='Talvez' id='talvez" . $cont . "' class='with-gap' /> <label
        							for='talvez" . $cont . "' class='black-text'>Talvez</label>";
                        else
                            echo "<input type='radio' name='resposta" . $cont . "' value='Talvez' id='talvez" . $cont . "' class='with-gap' /> <label
        							for='talvez" . $cont . "' class='black-text'>Talvez</label>";
                        echo "</div>
        					<div class='input-field col s12'>
        						<label for='obs" . $cont . "'>Observação:</label>
        						<textarea id='obs" . $cont . "' name='obs" . $cont . "'>" . $r['obs'] . "</textarea>
        					</div>
        				</div>";
                    } elseif ($pergunta->getIdTipoResposta() == TipoResposta::EXCELENTE_BOM_REGULAR_PESSIMO) {
                        echo "<div class='row col s12'>
        					<div class='col s12'>
        						<b>" . $cont . ". " . $pergunta->getDescricao() . "</b> ";
                        echo ($pergunta->isObrigatoria()) ? "<i class='blue-text'>*</i>" : "";
                        echo "</div>
        					<div class='col s12 center'>";
                        if ($r['resposta'] == "Excelente")
                            echo "<input type='radio' checked name='resposta" . $cont . "' value='Excelente' id='ex" . $cont . "' class='with-gap' /> <label
        							for='ex" . $cont . "' class='black-text'>Excelente</label>";
                        else
                            echo "<input type='radio' name='resposta" . $cont . "' value='Excelente' id='ex" . $cont . "' class='with-gap' /> <label
        							class='black-text' for='ex" . $cont . "'>Excelente</label>";
                        if ($r['resposta'] == "Bom")
                            echo "<input type='radio' checked name='resposta" . $cont . "'
        							value='Bom' id='bom" . $cont . "' class='with-gap' /> <label for='bom" . $cont . "' class='black-text'>Bom</label>";
                        else
                            echo "<input type='radio' name='resposta" . $cont . "'
        							value='Bom' id='bom" . $cont . "' class='with-gap' /> <label for='bom" . $cont . "' class='black-text'>Bom</label>";
                        if ($r['resposta'] == "Regular")
                            echo "<input type='radio' checked name='resposta" . $cont . "' value='Regular' id='reg" . $cont . "' class='with-gap' /> <label
        							for='reg" . $cont . "' class='black-text'>Regular</label>";
                        else
                            echo "<input type='radio' name='resposta" . $cont . "' value='Regular' id='reg" . $cont . "' class='with-gap' /> <label
        							for='reg" . $cont . "' class='black-text'>Regular</label>";
                        if ($r['resposta'] == "Péssimo")
                            echo "<input type='radio' checked name='resposta" . $cont . "' value='Péssimo' id='pes" . $cont . "' class='with-gap' /> <label
        							for='pes" . $cont . "' class='black-text'>Péssimo</label>";
                        else
                            echo "<input type='radio' name='resposta" . $cont . "' value='Péssimo' id='pes" . $cont . "' class='with-gap' /> <label
        							for='pes" . $cont . "' class='black-text'>Péssimo</label>";
                        echo "</div>
        					<div class='input-field col s12'>
        						<label for='obs" . $cont . "'>Observação:</label>
        						<textarea id='obs" . $cont . "' name='obs" . $cont . "'>" . $r['obs'] . "</textarea>
        					</div>
        				</div>";
                    }
                }
            }
            $cont ++;
        }
    }

    public function listPerguntas($idRelatorio)
    {
        $cont = 1;
        $controller = new ControllerPergunta();
        $respostaRelatorio = new RespostaDao();
        foreach ($controller->getAllAtivos() as $pergunta) {
            foreach ($respostaRelatorio->findByIdRelatorio($idRelatorio) as $resposta) {
                $r = $respostaRelatorio->findById($resposta['idResposta']);
                if ($r['idPergunta'] == $pergunta->getId()) {
                    if ($pergunta->getIdTipoResposta() == TipoResposta::PARAGRAFO) {
                        echo "<div class='row col s12'>
        					<div class='col s12'>
        						<b>" . $cont . ". " . $pergunta->getDescricao() . "</b>
        					</div>
        					<div class='col s12'>
        						<label>Resposta:</label><br>
        						<span>" . $r['resposta'] . "</span>
        					</div>
        				</div>";
                    } elseif ($pergunta->getIdTipoResposta() == TipoResposta::SIM_NAO) {
                        echo "<div class='row col s12'>
        					<div class='col s12'>
        						<b>" . $cont . ". " . $pergunta->getDescricao() . "</b>
        					</div>
        					<div class='col s12 center'>";
                        if ($r['resposta'] == "Sim")
                            echo "<input disabled='disabled' type='radio' checked value='Sim' id='sim" . $cont . "' class='with-gap' /> <label
        							for='sim" . $cont . "' class='black-text'>Sim</label>";
                        else
                            echo "<input disabled='disabled' type='radio' value='Sim' id='sim" . $cont . "' class='with-gap' /> <label
        							for='sim" . $cont . "' class='black-text'>Sim</label>";
                        if ($r['resposta'] == "Não")
                            echo "<input disabled='disabled' type='radio' checked
        							value='Não' id='nao" . $cont . "' class='with-gap' /> <label for='nao" . $cont . "' class='black-text'>Não</label>";
                        else
                            echo "<input disabled='disabled' type='radio'
        							value='Não' id='nao" . $cont . "' class='with-gap' /> <label for='nao" . $cont . "' class='black-text'>Não</label>";
                        echo "</div>
        					<div class='col s12'>
        						<label>Observação:</label><br>
        						<span>" . $r['obs'] . "</span>
        					</div>
        				</div>";
                    } elseif ($pergunta->getIdTipoResposta() == TipoResposta::SIM_NAO_TALVEZ) {
                        echo "<div class='row col s12'>
        					<div class='col s12'>
        						<b>" . $cont . ". " . $pergunta->getDescricao() . "</b>
        					</div>
        					<div class='col s12 center'>";
                        if ($r['resposta'] == "Sim")
                            echo "<input type='radio' checked disabled='disabled' value='Sim' id='sim" . $cont . "' class='with-gap' /> <label
        							for='sim" . $cont . "' class='black-text'>Sim</label>";
                        else
                            echo "<input type='radio' disabled='disabled' value='Sim' id='sim" . $cont . "' class='with-gap' /> <label
        							for='sim" . $cont . "' class='black-text'>Sim</label>";
                        if ($r['resposta'] == "Não")
                            echo "<input type='radio' disabled='disabled'
        							value='Não' id='nao" . $cont . "' class='with-gap' /> <label for='nao" . $cont . "' class='black-text'>Não</label>";
                        else
                            echo "<input type='radio' checked disabled='disabled'
        							value='Não' id='nao" . $cont . "' class='with-gap' /> <label for='nao" . $cont . "' class='black-text'>Não</label>";
                        if ($r['resposta'] == "Talvez")
                            echo "<input type='radio' checked disabled='disabled' value='Talvez' id='talvez" . $cont . "' class='with-gap' /> <label
        							for='talvez" . $cont . "' class='black-text'>Talvez</label>";
                        else
                            echo "<input type='radio' disabled='disabled' value='Talvez' id='talvez" . $cont . "' class='with-gap' /> <label
        							for='talvez" . $cont . "' class='black-text'>Talvez</label>";
                        echo "</div>
        					<div class='col s12'>
        						<label>Observação:</label><br>
        						<span>" . $r['obs'] . "</span>
        					</div>
        				</div>";
                    } elseif ($pergunta->getIdTipoResposta() == TipoResposta::EXCELENTE_BOM_REGULAR_PESSIMO) {
                        echo "<div class='row col s12'>
        					<div class='col s12'>
        						<b>" . $cont . ". " . $pergunta->getDescricao() . "</b>
        					</div>
        					<div class='col s12 center'>";
                        if ($r['resposta'] == "Excelente")
                            echo "<input type='radio' checked disabled='disabled' value='Excelente' id='ex" . $cont . "' class='with-gap' /> <label
        							for='ex" . $cont . "' class='black-text'>Excelente</label>";
                        else
                            echo "<input type='radio' disabled='disabled' value='Excelente' id='ex" . $cont . "' class='with-gap' /> <label
        							for='ex" . $cont . "' class='black-text'>Excelente</label>";
                        if ($r['resposta'] == "Bom")
                            echo "<input type='radio' checked disabled='disabled'
        							value='Bom' id='bom" . $cont . "' class='with-gap' /> <label for='bom" . $cont . "' class='black-text'>Bom</label>";
                        else
                            echo "<input type='radio' disabled='disabled'
        							value='Bom' id='bom" . $cont . "' class='with-gap' /> <label for='bom" . $cont . "' class='black-text'>Bom</label>";
                        if ($r['resposta'] == "Regular")
                            echo "<input type='radio' checked disabled='disabled' value='Regular' id='reg" . $cont . "' class='with-gap' /> <label
        							for='reg" . $cont . "' class='black-text'>Regular</label>";
                        else
                            echo "<input type='radio' disabled='disabled' value='Regular' id='reg" . $cont . "' class='with-gap' /> <label
        							for='reg" . $cont . "' class='black-text'>Regular</label>";
                        if ($r['resposta'] == "Péssimo")
                            echo "<input type='radio' checked disabled='disabled' value='Péssimo' id='pes" . $cont . "' class='with-gap' /> <label
        							for='pes" . $cont . "' class='black-text'>Péssimo</label>";
                        else
                            echo "<input type='radio' disabled='disabled' value='Péssimo' id='pes" . $cont . "' class='with-gap' /> <label
        							for='pes" . $cont . "' class='black-text'>Péssimo</label>";
                        echo "</div>
        					<div class='col s12'>
        						<label>Observação:</label><br>
        						<span>" . $r['obs'] . "</span>
        					</div>
        				</div>";
                    }
                }
            }
            $cont ++;
        }
    }
}
