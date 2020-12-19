import React, { useState } from "react";
import { register } from "../../WebAPI";
import styled from "styled-components";
import { useHistory } from "react-router-dom";

const ErrorMessage = styled.div`
  color: red;
`;
const RegisterPageWrapper = styled.div`
  text-align: center;
  margin: 100px;
`;
const InputInfo = styled.div`
  margin-bottom: 10px;
`;

export default function RegisterPage() {
  const [nickname, setNickname] = useState("");
  const [username, setUsername] = useState("");
  const [password, setPassword] = useState("");
  const [errorMessage, setErrorMessage] = useState();
  const history = useHistory();

  const handleSubmit = (e) => {
    setErrorMessage(null);
    register(nickname, username, password).then((data) => {
      if (data.ok === 0) {
        setErrorMessage(data.message);
      } else if (data.ok === 1) {
        history.push("/login")
      }

    });
  };

  return (
    <RegisterPageWrapper>
      <form onSubmit={handleSubmit}>
        <InputInfo>
          nickname:
          <input
            value={nickname}
            onChange={(e) => setNickname(e.target.value)}
          />
        </InputInfo>
        <InputInfo>
          username:
          <input
            value={username}
            onChange={(e) => setUsername(e.target.value)}
          />
        </InputInfo>
        <InputInfo>
          password:
          <input
            value={password}
            onChange={(e) => setPassword(e.target.value)}
          />
        </InputInfo>
        <button>POST</button>
        {errorMessage && <ErrorMessage>{errorMessage}</ErrorMessage>}
      </form>
    </RegisterPageWrapper>
  );
}
