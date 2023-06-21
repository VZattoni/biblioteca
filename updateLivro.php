<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/style.css">
    <title>Biblioteca</title>
</head>

<body>
<?php require 'db/conectaBD.php'; ?>
<?php
        session_start();
        if (!isset($_SESSION['login'])) {                              // Não houve login ainda
            unset($_SESSION['nao_autenticado']);
            unset($_SESSION['mensagem_header']);
            unset($_SESSION['mensagem']);
            header('location: /biblioteca/index.php');    // Vai para a página inicial
            exit();
        }

        $id = $_GET['id']; // Obtém PK do Médico que será atualizado

		$conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("<strong> Falha de conexão: </strong>" . $conn->connect_error);
        }

        $sql = "SELECT titulo, id_autor FROM livros WHERE id = $id";


        if ($result = $conn->query($sql)) {   // Consulta ao BD ok
            if ($result->num_rows == 1) {          // Retorna 1 registro que será atualizado  
                $row = $result->fetch_assoc();

                $titulo = $row['titulo'];
                $id_autor = $row['id_autor'];

                // Obtém as Especialidades Médicas na Base de Dados para um combo box
                $sqlG = "SELECT id, nome FROM autores";
                $result = $conn->query($sqlG);
                $optionsEspec = array();

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        array_push($optionsEspec, "\t\t\t<option value='" . $row["id"] . "'>" . $row["nome"] . "</option>\n");
                    }
                } else {
                    echo "Erro executando SELECT: " . $conn->connect_error;
                }

				?>
						
                        <div class="container" id="list-update">
							<h2>Altere os dados do livro de Id = <?php echo $id; ?></h2>
						
						<form class="form-update" action="updateExe.php" method="post" enctype="multipart/form-data">
							<table class='table'>
								<tr>
									<td style="width:50%;">
										
										<p class="p-form">
                                        
                                        <input type="hidden" id="Id" name="Id" value="<?php echo $id; ?>">
										
										<label class="w3-text-IE"><b>Título</b></label>
										<input name="titulo" type="text" value="<?php echo $titulo; ?>" required>
										
										
										<p class="p-form"><label class="w3-text-IE"><b>Autor</b>*</label>
											<select name="autor" id="autor" required>
											<?php
											foreach ($optionsEspec as $key => $value) {
												echo $value;
											}
											?>
											</select>
										</p>

									</td>
								</tr>
								<tr>
									<td colspan="2" style="text-align:center">
									<div class="btn-update">
										<input type="submit" value="Alterar" class="">
										<input type="button" value="Cancelar" class="" onclick="window.location.href='listarLivros.php'">
									</div>
									</td>
								</tr>
							</table>
							<br>
						</form>
					<?php
					} else { ?>
						<div class="w3-container w3-theme">
							<h2>Livro inexistente</h2>
						</div>
						<br>
				<?php
					}
				} else {					
					echo "<p style='text-align:center'>Erro executando UPDATE: " . $conn->connect_error . "</p>";
				}
				echo "</div>"; //Fim form
				$conn->close(); //Encerra conexao com o BD
				?>
			</div>
            </div>
			</p>
		</div>
</body>

</html>