<!-- Content wrapper -->
<div class="content-wrapper">
            <!-- Content -->

            <div class="container-fluid flex-grow-1 container-p-y">

              <div class="row">
              <div class="col-12 mb-4">
                  <div class="alert alert-primary alert-dismissible" role="alert">
                    <div class="me-auto fw-semibold pb-2"><i class="bx bx-error pb-1"></i> pemberitahuan !</div>
                    Biodata yang kamu isi akan ditampilkan pada halaman direktori mahasiswa, kecuali email dan nomor HP. <br> 
                    kamu dapat mengosongkan beberapa field form jika kamu merasa data tersebut merupakan privasi
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="card mb-4">
                    <h5 class="card-header">Biodata ku</h5>
                    <!-- Account -->
                    <form id="formAccountSettings" method="POST" action="<?= base_url('user/biodata_update') ?>" >
                      <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                          <img
                            src="<?= base_url('file/').$user['foto'] ?>"
                            alt="user-avatar"
                            class="d-block rounded"
                            height="100"
                            width="100"
                            id="uploadedAvatar"
                          />
                          <div class="button-wrapper">
                            <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                              <span class="d-none d-sm-block">Upload new photo</span>
                              <i class="bx bx-upload d-block d-sm-none"></i>
                              <input
                                type="file"
                                id="upload"
                                class="account-file-input"
                                hidden
                                accept="image/png, image/jpeg"
                              />
                            </label>
                            <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                              <i class="bx bx-reset d-block d-sm-none"></i>
                              <span class="d-none d-sm-block">Reset</span>
                            </button>

                            <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 2MB</p>
                          </div>
                        </div>
                      </div>
                      <hr class="my-0" />
                      <div class="card-body">
                        <div class="row">
                          <div class="mb-3 col-md-6">
                            <label for="nim" class="form-label">NIM</label>
                            <input class="form-control" type="text" value="<?php echo htmlentities($user['nim'], ENT_QUOTES, 'UTF-8');?>" readonly id="nim" />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="email" class="form-label">E-mail</label>
                            <input
                              class="form-control"
                              type="email"
                              id="firstName"
                              name="email"
                              value="<?php echo htmlentities($user['email'], ENT_QUOTES, 'UTF-8');?>"
                              autofocus
                              required
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input
                              class="form-control"
                              type="text"
                              id="nama"
                              name="nama"
                              value="<?php echo htmlentities($user['nama'], ENT_QUOTES, 'UTF-8');?>"
                              placeholder="Nama Lengkap"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="jk" class="form-label">Jenis Kelamin</label>
                            <select id="jk" name="jk" class="select2 form-select">
                            <?php if($user['kelamin'] == 'laki-laki') { ?>
                              <option value="laki-laki">Laki Laki</option>
                              <option value="perempuan">Perempuan</option>
                            </select>
                            <?php }elseif($user['kelamin'] == 'perempuan') { ?>
                              <option value="perempuan">Perempuan</option>
                              <option value="laki-laki">Laki Laki</option>
                            <?php }else { ?>
                              <option value="">Pilih Jenis Kelamin</option>
                              <option value="laki-laki">Laki Laki</option>
                              <option value="perempuan">Perempuan</option>
                            <?php } ?>
                            </select>    
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="Tempat_lahir" class="form-label">Tempat Lahir</label>
                            <input
                              type="text"
                              class="form-control"
                              id="Tempat_lahir"
                              name="tempat_lahir"
                              value="<?php echo htmlentities($user['tempat_lahir'], ENT_QUOTES, 'UTF-8');?>"
                              placeholder="Tempat Lahir"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="Tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input
                              type="date"
                              class="form-control"
                              id="Tanggal_lahir"
                              name="tgl_lahir"
                              value="<?php echo htmlentities($user['tgl_lahir'], ENT_QUOTES, 'UTF-8');?>"
                              placeholder="Tanggal Lahir"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="agama" class="form-label">Agama</label>
                            <select id="agama" name="agama" class="select2 form-select">
                            <?php if($user['agama'] == 'islam') { ?>
                              <option value="islam">Islam</option>
                              <option value="kristen protestan">Kristen Protestan</option>
                              <option value="katolik">Katolik</option>
                              <option value="hindu">Hindu</option>
                              <option value="budha">Budha</option>
                            </select>
                            <?php }elseif($user['agama'] == 'kristen protestan') { ?>
                              <option value="kristen protestan">Kristen Protestan</option>
                              <option value="islam">Islam</option>
                              <option value="katolik">Katolik</option>
                              <option value="hindu">Hindu</option>
                              <option value="budha">Budha</option>
                            <?php }elseif($user['agama'] == 'katolik') { ?>
                              <option value="katolik">Katolik</option>
                              <option value="kristen protestan">Kristen Protestan</option>
                              <option value="islam">Islam</option>
                              <option value="hindu">Hindu</option>
                              <option value="budha">Budha</option>
                              <?php }elseif($user['agama'] == 'hindu') { ?>
                                <option value="hindu">Hindu</option>
                              <option value="katolik">Katolik</option>
                              <option value="kristen protestan">Kristen Protestan</option>
                              <option value="islam">Islam</option>
                              <option value="budha">Budha</option>
                            <?php }elseif($user['agama'] == 'budha') { ?>
                              <option value="budha">Budha</option>
                              <option value="hindu">Hindu</option>
                              <option value="katolik">Katolik</option>
                              <option value="kristen protestan">Kristen Protestan</option>
                              <option value="islam">Islam</option>
                            <?php }else { ?>
                              <option value="">Pilih Agama</option>
                              <option value="islam">Islam</option>
                              <option value="kristen protestan">Kristen Protestan</option>
                              <option value="katolik">Katolik</option>
                              <option value="hindu">Hindu</option>
                              <option value="budha">Budha</option>
                            <?php } ?>
                            </select>
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="hobi" class="form-label">Hobi</label>
                            <input
                              type="text"
                              class="form-control"
                              id="hobi"
                              name="hobi"
                              value="<?php echo htmlentities($user['hobi'], ENT_QUOTES, 'UTF-8');?>"
                              placeholder="Hobi"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="asal" class="form-label">Alamat Asal</label>
                            <input
                              type="text"
                              class="form-control"
                              id="asal"
                              name="asal"
                              value="<?php echo htmlentities($user['alamat_asal'], ENT_QUOTES, 'UTF-8');?>"
                              placeholder="Alamat Asal"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="kost" class="form-label">Alamat Asal</label>
                            <input
                              type="text"
                              class="form-control"
                              id="kost"
                              name="kost"
                              value="<?php echo htmlentities($user['alamat_kost'], ENT_QUOTES, 'UTF-8');?>"
                              placeholder="Alamat Kost"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="wa" class="form-label">No. HP/WA</label>
                            <input
                              type="number"
                              class="form-control"
                              id="wa"
                              name="wa"
                              value="<?php echo htmlentities($user['wa'], ENT_QUOTES, 'UTF-8');?>"
                              placeholder="No. HP/WA"
                            />
                          </div>
                          <div class="mb-3 col-md-6">
                            <label for="ig" class="form-label">Instagram</label>
                            <input
                              type="text"
                              class="form-control"
                              id="ig"
                              name="ig"
                              value="<?php echo htmlentities($user['ig'], ENT_QUOTES, 'UTF-8');?>"
                              placeholder="Username Instagram"
                            />
                          </div>
                          <div class="mb-3 col-md-12">
                            <label for="quotes" class="form-label">Quotes</label>
                            <textarea class="form-control" id="quotes" name="quotes" rows="3"><?php echo htmlentities($user['quotes'], ENT_QUOTES, 'UTF-8');?></textarea>
                          </div>
                        </div>
                        <div class="mt-2">
                          <button type="submit" class="btn btn-primary me-2">Save changes</button>
                          <button type="reset" class="btn btn-outline-secondary">Reset</button>
                        </div>
                      </form>
                    </div>
                    <!-- /Account -->
                  </div>
                </div>
              </div>
            </div>
            <!-- / Content -->