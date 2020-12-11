import React, { useState, useContext } from "react";
import { newPost } from "../../WebAPI";
import { AuthContext } from "../../contexts";
import styled from "styled-components";
import { useHistory } from "react-router-dom";

const ErrorMessage = styled.div`
  color: red;
`;
const NewPostPageWrapper = styled.div`
  margin: 100px auto;
  font-size: 20px;
  text-align: center;
`;
const Info = styled.div`
  margin: 0px auto;
`;
const User = styled.div`
  margin-bottom: 40px;
`;

export default function NewPostPage() {
  const { user } = useContext(AuthContext);
  const [title, setTitle] = useState("");
  const [content, setContent] = useState("");
  const [errorMessage, setErrorMessage] = useState();
  const history = useHistory();

  const handleSubmit = (e) => {
    e.preventDefault();
    setErrorMessage(null);
    newPost(title, content).then((data) => {
      if (data.ok === 0) {
        setErrorMessage(data.message);
      }
      history.push("/");
    });
  };
  if (!user) {
    return null;
  }
  return (
    <NewPostPageWrapper>
      <form onSubmit={handleSubmit}>
        <User>嗨，{user.username}，有什麼話要說嗎？</User>
        <Info>title:</Info>
        <textarea
          cols="50"
          value={title}
          onChange={(e) => setTitle(e.target.value)}
        />
        <Info>content:</Info>
        <textarea
          rows="10"
          cols="50"
          value={content}
          onChange={(e) => setContent(e.target.value)}
        />
        <div>
          <button>POST</button>
        </div>
        {errorMessage && <ErrorMessage>{errorMessage}</ErrorMessage>}
      </form>
    </NewPostPageWrapper>
  );
}
