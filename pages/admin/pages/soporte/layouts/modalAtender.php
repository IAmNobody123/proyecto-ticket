<div class="modal fade" id="modalAtender" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="myModalLabel">Designar tarea a un practicante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action=""> <!-- Cambia 'procesar.php' por tu archivo PHP -->
                    <input type="hidden" name="idProblema" id="idProblema"> <!-- Campo oculto para el idProblema -->
                    <label for="selPrac">Selecciona un practicante</label>
                    <select name="selectorPracticante" id="selPrac">
                        <option value="">Seleccionar</option>
                        <?php
                        // Mostrar las sedes en el menú desplegable
                        while ($row = $resultPracticantes->fetch_object()) {
                            echo "<option value='{$row->idUsuario}'>{$row->nombre}</option>";
                        }
                        ?>
                    </select>
                    <div class="modal-footer justify-content-center">
                        <button type="submit" name="submit" class="btn btn-secondary me-2">Designar</button>
                        <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>