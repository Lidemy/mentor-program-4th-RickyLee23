import React from "react";
import styled from "styled-components";
import scene from "../../pictures/scene.jpg";

const AboutMeContainer = styled.div`
  text-align: center;
  width: 570px;
  margin: 80px auto;
  box-shadow: 2px 2px 2px 1px rgba(0, 0, 0, 0.2);
`;
const Picture = styled.div`
  background-image: url(${scene});
  background-position: center center;
  height: 300px;
  max-width: 100%;
`;

const Description = styled.div`
  padding: 20px;
`;

export default function AboutMePage() {
  return (
    <AboutMeContainer>
      <Picture />
      <Description>這裡是一個非技術超簡易部落格＾＾歡迎光臨</Description>
    </AboutMeContainer>
  );
}
