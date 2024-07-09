CREATE TABLE tb_alunos(
    cpf TEXT PRIMARY KEY,
    nome TEXT,
    email TEXT
);

CREATE TABLE tb_telefones(
    ddd TEXT,
    numero TEXT,
    cpf_aluno TEXT,
    PRIMARY KEY(ddd, numero),
    FOREIGN KEY(cpf_aluno) REFERENCES tb_alunos(cpf)
);

CREATE TABLE tb_indicacoes(
    cpf_indicante TEXT,
    cpf_indicado TEXT,
    data_indicacao TEXT,
    PRIMARY KEY(cpf_indicante, cpf_indicado),
    FOREIGN KEY(cpf_indicante) REFERENCES tb_alunos(cpf),
    FOREIGN KEY(cpf_indicado) REFERENCES tb_alunos(cpf)
);